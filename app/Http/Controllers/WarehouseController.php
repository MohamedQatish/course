<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Http\Resources\MedicineCollection;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PharmacistCollection;
use App\Http\Resources\warehouseReportCollection;
use App\Http\Resources\WarehouseResource;
use App\Models\Order;
use App\Models\Pharmacist;
use App\Notifications\OrderSentNotification;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WarehouseController extends Controller
{
    public function register(StoreWarehouseRequest $request){
        $data=$request->validated();
        $data['password']=Hash::make($data['password']);
        $warehouse=Warehouse::create($data);
        $token=$warehouse->createToken('warehouse')->plainTextToken;
        return response()->json([
            'warehouse'=>new WarehouseResource($warehouse),
            'token'=>$token
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $warehouse = Warehouse::where('email', $request->email)->first();

        if ($warehouse) {
            if (Hash::check($request->password, $warehouse->password)) {
                $token = $warehouse->createToken('warehouse')->plainTextToken;

                return response()->json([
                    'pharmacist'=>new WarehouseResource($warehouse),
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'message' => 'Wrong password',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Wrong email',
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

    public function myMedicines(){
        try{
            $warehouse=Auth::user();
            $medicines=$warehouse->medicines;
            return response()->json([
                'medicines'=>new MedicineCollection($medicines)
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

    public function medicines(Warehouse $warehouse){
        try{
            $medicines=$warehouse->medicines;
            return response()->json([
                'medicines'=>new MedicineCollection($medicines)
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

    public function orders(){
        $warehouse=Auth::user();
        $orders=$warehouse->orders;
        return response()->json([
            'orders'=> new OrderCollection($orders)
        ]);
    }
    public function sendOrder(Order $order){
        // $warehouse = Warehouse::find($order->warehouse_id);
        // $medicines=$order->medicines;

        $pharmacist=Pharmacist::find($order->pharmacist_id);
        $order->update([
            'status'=>'sent'
        ]);
        $pharmacist->notify(new OrderSentNotification($order));

        return response()->json([
            'order'=>new OrderResource($order)
        ]);

    }
    public function orderPaid(Order $order){
            if($order->payment_status==='paid'){
                return response()->json([
                    'message'=>'this order is already been paid'
                ]);
            }
            $order->update([
                'payment_status'=>'paid'
            ]);
            return response()->json([
                'order'=>new OrderResource($order)
            ]);

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

            $warehouse = Auth::user();

            //$orders = $pharmacist->orders()->whereBetween('created_at', [$from, $to])->get();
            // $orders = $warehouse->orders()
            // ->where('created_at', '>=', $from)
            // ->where('created_at', '<=', $to)
            // ->with('medicines')
            // ->get();

            $orders= $warehouse->orders->where('created_at','>=',$from);
            $orders=$orders->where('created_at','<=',$to);
            // return response()->json([
            //     'error'=>$orders
            // ]);
            $invoice=0;
            $received=0;
            $pharmacists=[];
            $sold=0;
            $soldMedicines=[];
            foreach($orders as $order){
                if($order->payment_status ==="paid"){
                    $received+=$order->invoice;
                    $medicines=$order->medicines;
                    $sold+=count($medicines);
                    foreach($order->medicines as $med){
                        $soldMedicines[]=$med;
                    }
                }
                $invoice+=$order->invoice;
                $pharmacists[]=$order->pharmacist;
            }
            $pharmacists1=collect($pharmacists)->unique()->values()->all();

            return response()->json([
                'you have delt with'=>count($pharmacists1).' pharmacists',
                'pharmacists'=>new PharmacistCollection($pharmacists1),
                'you have been orderd with'=>count($orders).' orders',
                'orders' =>new warehouseReportCollection($orders),
                'you have sold'=>$sold.' medicines',
                'the medicines you sold'=>new MedicineCollection($soldMedicines),
                'the total invoice'=>$invoice,
                'your income'=>$received
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
     // $order1=Order::find($order)->first();
        // $order->update([
        //     'status'=>'sent'
        // ]);
        // $medicine=$order->medicine()->first();
        // $medicine->update([
        //     'quantity'=>$medicine->quantity-$order->quantity
        // ]);

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
    public function store(StoreWarehouseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
