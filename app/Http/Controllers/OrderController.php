<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Medicine;
use App\Models\OrderMedicine;
use App\Models\Warehouse;
use App\Notifications\NewOrder;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */




    // $warehouse=Warehouse::findorfail($request->warehouse_id)->first();
    // $medicine=$warehouse->medicines()->where('commercial_name',$request->medicine)->first();
    // if($medicine !== null){
    //     if($request->quantity > $medicine->quantity){
    //         return response()->json([
    //             'message'=>'Requested quantity exceeds the available quantity!'
    //         ],422);
    //     }else{
    //         $order=Order::create([
    //             'warehouse_id'=>$request->warehouse_id,
    //             'pharmacist_id'=>Auth::user()->id,
    //             'medicine'=>$request->medicine,
    //             'quantity'=>$request->quantity,
    //             'status' => 'preparing',
    //             'payment_status' => 'unpaid'
    //     ]);
    //         return response()->json([
    //             'message' => 'Your order has been successfully processed and stored.',
    //             'Order'=>new OrderResource($order),
    //         ]);
    //     }
    // }else{
    //     return response()->json([
    //         'message'=>'the medicine you orderd was not found'
    //     ],404);
    // }




    // public function store(StoreOrderRequest $request)
    // {
    //     try {
    //         $order = Order::create([
    //             'warehouse_id' => $request->warehouse_id,
    //             'pharmacist_id' => Auth::user()->id,
    //             'invoice' => 0
    //         ]);
    //         $warehouse = Warehouse::findorfail($order->warehouse_id);
    //         foreach ($request->medicines as $medicine) {
    //             $check = $warehouse->medicines()->where('commercial_name', $medicine->commercial_name)->first();
    //             if ($check !== null) {
    //                 if ($check->quantity < $medicine->quantity) {
    //                     $order->delete();
    //                     return response()->json([
    //                         'message' => 'Requested quantity for ' . $medicine->commercial_name . ' exceeds the available quantity!'
    //                     ]);
    //                 }
    //             } else {
    //                 $order->delete();
    //                 return response()->json([
    //                     'message' => $medicine->commercial_name . ' is not available!'
    //                 ]);
    //             }
    //         }
    //         $invoice = 0.0;
    //         foreach ($request->medicines as $medicine) {
    //             $medicine1 = $warehouse->medicines()->where('commercial_name', $medicine->commercial_name)->first();
    //             OrderMedicine::create([
    //                 'order_id' => $order->id,
    //                 'scientific_name' => $medicine1->scientific_name,
    //                 'commercial_name' => $medicine1->commercial_name,
    //                 'category' => $medicine1->category,
    //                 'the_manufacture_company' => $medicine1->the_manufacture_company,
    //                 'quantity' => $medicine->quantity,
    //                 'expire_date' => $medicine1->expire_date,
    //                 'price' => $medicine1->price,
    //             ]);
    //             // $medicine1->update([
    //             //     'quantity'=>$medicine1->quantity - $medicine->quantity
    //             // ]);
    //             $invoice += ($medicine->quantity * $medicine1->price);
    //             //$invoice=$invoice + ($medicine->quantity*$medicine1->price);
    //         }
    //         $order->update([
    //             'invoice' => $invoice
    //         ]);
    //         Notification::send($warehouse,new NewOrder($order));
    //     } catch (Exception $e) {
    //     }
    // }


    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::create([
                'warehouse_id' => 1,
                'pharmacist_id' => Auth::user()->id,
                'invoice' => 0,
                'status' => 'preparing',
                'payment_status' => 'unpaid'
            ]);

            $warehouse = Warehouse::findOrFail($order->warehouse_id);


            foreach ($request->medicines as $medicine) {

                $check = $warehouse->medicines()->where('commercial_name', $medicine['commercial_name'])->first();

                if (!$check || $check->quantity < $medicine['quantity']) {
                    DB::rollBack();
                    return response()->json([
                        'message' => !$check ? $medicine['commercial_name'] . ' is not available!' : 'Requested quantity for '
                            . $medicine['commercial_name'] . ' exceeds the available quantity! the available quantity is: ' . $check->quantity
                    ], 422); // Unprocessable Entity
                }

                OrderMedicine::create([
                    'order_id' => $order->id,
                    'scientific_name' => $check->scientific_name,
                    'commercial_name' => $check->commercial_name,
                    'category' => $check->category,
                    'the_manufacture_company' => $check->the_manufacture_company,
                    'quantity' => $medicine['quantity'],
                    'expire_date' => $check->expire_date,
                    'price' => $check->price,
                ]);


                $check->update([
                    'quantity' => $check->quantity - $medicine['quantity']
                ]);

                $order->invoice += ($medicine['quantity'] * $check->price);
            }

            $order->save();

            $warehouse->notify(new NewOrder($order));


            DB::commit();

            return response()->json([
                'message' => 'Order created successfully',
                'order' => new OrderResource($order),
            ], 201); // HTTP 201 Created
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error occurred while processing the order. ' . $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }

    //     public function store(StoreOrderRequest $request){
    //
    //     try {
    //         $medicine = Medicine::where('commercial_name', 'like', $request->medicine)->firstOrFail();

    //         if ($request->quantity > $medicine->quantity) {
    //             return response()->json([
    //                 'message' => 'Requested quantity exceeds the available quantity!',
    //             ], 422);
    //         }

    //         $order = Order::create([
    //             'pharmacist_id' => Auth::user()->id,
    //             'medicine' => $request->medicine,
    //             'quantity' => $request->quantity,
    //         ]);

    //         return response()->json([
    //             'message' => 'Your order has been successfully processed and stored.',
    //             'order' => new OrderResource($order),
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'The medicine you ordered was not found.',
    //         ], 404);
    //     }
    // }


    /**
     * Display the specified resource.
     */


    public function show2(Order $order)
    {
        $order1 = Order::find($order);
        if ($order1 !== null) {
            return response()->json([
                'order' => new OrderResource($order1)
            ]);
        } else {
            return response()->json([
                'message' => 'the order was not found',
            ], 404);
        }
    }


    public function show(Order $order)
    {
        try {
            if ($order !== null) {
                $order->load(['medicines', 'pharmacist', 'warehouse']);
                return response()->json([
                    'order' => new OrderResource($order)
                ]);
            } else {
                return response()->json([
                    'message' => 'The order was not found',
                ], 404);
            }
        } catch (\Exception $e) {
            // Log the exception for further investigation
            Log::error('Exception in OrderController@show: ' . $e->getMessage());

            // Return a detailed error response for debugging
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage(), // Add this line to include the exception message in the response
            ], 500); // Internal Server Error
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
