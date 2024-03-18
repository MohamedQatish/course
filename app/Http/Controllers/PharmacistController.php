<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Pharmacist;
use App\Http\Requests\StorePharmacistRequest;
use App\Http\Requests\UpdatePharmacistRequest;
use App\Http\Resources\MedicineCollection;
use App\Http\Resources\MedicineResource;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\PharmacistResource;
use App\Http\Resources\WarehouseCollection;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\PharmacistFavoriteMedicine;
use App\Models\PharmacistMedicine;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PDO;

use function Laravel\Prompts\password;

class PharmacistController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function register(StorePharmacistRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $pharmacist = Pharmacist::create($data);
        $token = $pharmacist->createToken('pharmacist')->plainTextToken;
        return response()->json([
            'pharmacist' => new PharmacistResource($pharmacist),
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => ['required'],
            'password' => ['required'],
        ]);

        $pharmacist = Pharmacist::where('phone_number', $request->phone_number)->first();

        if ($pharmacist) {
            if (Hash::check($request->password, $pharmacist->password)) {
                $token = $pharmacist->createToken('pharmacist')->plainTextToken;

                return response()->json([
                    'pharmacist' => new PharmacistResource($pharmacist),
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'message' => 'Wrong password',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Wrong phone number',
            ]);
        }
    }

    public function logout(Request $request)
    {
        //  $pharmacist = Auth::user();
        //  $pharmacist->tokens->each(function ($token) {
        //      $token->delete();
        //  });
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }



    public function orders()
    {
        try {
            $pharmacist = Auth::user();
            $orders = $pharmacist->orders;
            return response()->json([
                'pharmacist' => new PharmacistResource($pharmacist),
                'orders' => new OrderCollection($orders)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function addToFavorites($medicineId)
    {
        try {
            $medicine = Medicine::findorfail($medicineId);
            $pharmacist = Auth::user();
            $medicines = $pharmacist->favoriteMedicines;
            foreach ($medicines as $favMedicine) {
                // if($favMedicine['medicine_id']){
                //     return response()->json([
                //         'message'=>$favMedicine['medicine_id']
                //     ]);
                // }
                if ($favMedicine['medicine_id'] == $medicineId) {
                    return response()->json([
                        'message' => 'you have this medicine in your favorites list'
                    ]);
                }
            }
            PharmacistFavoriteMedicine::create([
                'pharmacist_id' => Auth::user()->id,
                'medicine_id' => $medicine->id,
                // 'scientific_name'=>$medicine->scientific_name,
                // 'commercial_name'=>$medicine->commercial_name,
                // 'category'=>$medicine->category,
                // 'the_manufacture_company'=>$medicine->the_manufacture_company,
                // 'quantity'=>$medicine->quantity,
                // 'expire_date'=>$medicine->expire_date,
                // 'price'=>$medicine->price
            ]);
            return response()->json([
                'message' => 'you have added this medicine to your favorite medicines',
                'medicine' => new MedicineResource($medicine)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }


    // public function showFavorites(){
    //     $pharmacist=Pharmacist::find(Auth::user()->id);
    //     return response()->json([
    //         'favorite medicines'=>new MedicineCollection($pharmacist->favoriteMedicines->medicine)
    //     ]);
    // }



    public function showFavorites()
    {
        try {
            $pharmacist = Pharmacist::findOrFail(Auth::user()->id);
            $favoriteMedicines = $pharmacist->favoriteMedicines;

            return response()->json([
                'favorite_medicines' => new MedicineCollection($favoriteMedicines->pluck('medicine')),
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }




    public function orderReceived(Order $order)
    {
        if ($order->status === 'sent') {
            $medicines = $order->medicines;
            foreach ($medicines as $medicine) {
                PharmacistMedicine::create([
                    'pharmacist_id' => Auth::user()->id,
                    'scientific_name' => $medicine->scientific_name,
                    'commercial_name' => $medicine->commercial_name,
                    'category' => $medicine->category,
                    'the_manufacture_company' => $medicine->the_manufacture_company,
                    'quantity' => $medicine->quantity,
                    'expire_date' => $medicine->expire_date,
                    'price' => $medicine->price
                ]);
            }
            $order->update([
                'status' => 'received'
            ]);
            return response()->json([
                'message' => 'Order marked as received. Medicines added to your inventory.'
            ]);
        }
    }

    public function myMedicines()
    {
        try {
            $pharmacist = Auth::user();
            $medicines = $pharmacist->medicines;
            return response()->json([
                'medicines' => new MedicineCollection($medicines)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function report(Request $request)
    {
        try {
            $this->validate($request, [
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from',
            ]);


            $from = $request->from;
            $to = $request->to;

            $pharmacist = Auth::user();

            //$orders = $pharmacist->orders()->whereBetween('created_at', [$from, $to])->get();
            $orders = $pharmacist->orders->where('created_at', '>=', $from);
            $orders = $orders->where('created_at', '<=', $to);
            // return response()->json([
            //     'error'=>$orders
            // ]);
            $invoice = 0;
            $paid = 0;
            $warehouses = [];
            foreach ($orders as $order) {
                if ($order->payment_status === "paid") {
                    $paid += $order->invoice;
                }
                $invoice += $order->invoice;
                $warehouses[] = $order->warehouse;
            }
            $warehouses1 = collect($warehouses)->unique()->values()->all();

            return response()->json([
                'you have orderd' => count($orders) . ' orders',
                'orders' => new OrderCollection($orders),
                'you have delt with' => count($warehouses1) . ' warehouses',
                'warehouses' => new WarehouseCollection($warehouses1),
                'your invoice' => $invoice,
                'you have paid' => $paid
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->validator->errors(),
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing the report. ' . $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }
    public function notifications()
    {
        $pharmacist = Auth::user();
        $notification = $pharmacist->unReadNotifiction;
        return response()->json([
            'notifications' => new NotificationCollection($notification)
        ]);
    }
    public function noti()
    {
        $pharmacist = Auth::user();
        $notifications = $pharmacist->unReadNotifiction;
        if ($notifications) {
            return response()->json([
                'notifications' => new NotificationCollection($notifications)
            ]);
        } else {
            return response()->json([
                'message' => 'there is no notifications'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacist $pharmacist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pharmacist $pharmacist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmacistRequest $request, Pharmacist $pharmacist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacist $pharmacist)
    {
        //
    }
}
