<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\WarehouseController;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// http://127.0.0.1:8000/api/pharmacists/
Route::group(['prefix' => '/pharmacists'], function () {
        Route::post('register', [PharmacistController::class, 'register']);
        Route::post('login', [PharmacistController::class, 'login']);

        Route::middleware(['auth:sanctum', 'isPharmacist'])->group(function () {
        Route::post('/orders/store', [OrderController::class,'store']); //for requesting an order
        Route::get('/orders', [PharmacistController::class, 'orders']); //showing the pharmacist orders
        Route::post('logout', [PharmacistController::class, 'logout']);
        Route::post('/addToFavorites/{medicineId}',[PharmacistController::class,'addToFavorites']);
        Route::get('/showFavorites',[PharmacistController::class,'showFavorites']);
        Route::post('/orderReceived/{order}',[PharmacistController::class,'orderReceived']);
        Route::get('myMedicines',[PharmacistController::class, 'myMedicines']);
        Route::get('report',[PharmacistController::class, 'report']);   // takes two parameters (from,to)
        Route::get('unReadNotifications',[PharmacistController::class, 'unReadNotifications']);
        Route::get('notifications',[PharmacistController::class,'notifications']);
        Route::get('noti',[PharmacistController::class,'noti']);
    });
});

// http://127.0.0.1:8000/api/warehouses/

Route::group(['prefix' => '/warehouses'], function () {
    Route::post('register', [WarehouseController::class, 'register']);

    Route::post('login', [WarehouseController::class, 'login']);

    Route::middleware(['auth:sanctum', 'isWarehouse'])->group(function () {

        Route::post('logout', [WarehouseController::class, 'logout']);
        Route::get('/orders', [WarehouseController::class, 'orders']);   //showing the warehouse orders
        // Route::get('myMedicines',[WarehouseController::class, 'myMedicines']);
        Route::get('report', [WarehouseController::class, 'report']);    // takes two parameters (from,to)
    });
});

Route::middleware(['auth:sanctum', 'isWarehouse'])->group(function () {
    Route::post('/medicines/store', [MedicineController::class, 'store']);
    Route::post('/orders/sendOrder/{order}',[WarehouseController::class,'sendOrder']); // sets the order status to 'sent'
                                                                                       //and notify the pharmacist

    Route::post('orders/orderPaid/{order}',[WarehouseController::class,'orderPaid']);  //sets the order payment status
                                                                                       //to 'paid'
});


// http://127.0.0.1:8000/api/medicines/

Route::group(['prefix' => '/medicines', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{medicine}',[MedicineController::class,'show']);
    Route::get('/search',[MedicineController::class,'search']);
    Route::get('/searchByName/{search}',[MedicineController::class,'searchByName']);
    Route::get('/showByCategory/{category}',[MedicineController::class,'showByCategory']);
    Route::get('/searchByCategory/{category}',[MedicineController::class,'searchByCategory']);
    Route::get('',[MedicineController::class,'index']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('orders/{order}',[OrderController::class,'show']);
    Route::get('warehouses/medicines/{warehouse}',[WarehouseController::class,'medicines']);
});
