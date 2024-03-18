<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\MedicineCollection;
use App\Http\Resources\MedicineResource;
use App\Models\MedicineCategory;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = new MedicineCollection(Medicine::all());
        return response()->json([
            'medicines' => new MedicineCollection($medicines)
        ]);
    }


    public function showByCategory(MedicineCategory $category)
    {
        try {
            $medicines = $category->medicines;
            return response()->json([
                'category' => $category->category,
                'medicines' => new MedicineCollection($medicines),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //Display medicines by category
    //     public function showByCategory($category)
    // {
    //     try {
    //         $medicines = Medicine::where('category', $category)->get();

    //         if ($medicines->isEmpty()) {
    //             return response()->json([
    //                 'message' => 'No medicines found for the category: ' . $category,
    //             ]);
    //         }

    //         return response()->json([
    //             'category' => $category,
    //             'medicines' => new MedicineCollection($medicines),
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function searchByName($search)
    {
        try {
            $medicines = Medicine::where('commercial_name', 'like', '%' . $search . '%')->get();
            if ($medicines->isEmpty()) {
                return response()->json([
                    'message' => 'No medicines found for the name: ' . $search,
                ]);
            }

            return response()->json([
                'medicines' => new MedicineCollection($medicines),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function searchByCategory($category)
    {
        $found = MedicineCategory::where('category', $category)->get();

        if ($found) {
            $f =  Medicine::where('medicine_category_id', $category->id)->get();
            return response()->json([
                'category in medicine' => $f,
            ]);
        }
    }
    // public function searchByCategory(Request $request)
    // {
    //     $medicines = Medicine::where('category', 'like', '%' . $request->category . '%')->get();
    //     if (count($medicines)) {
    //         return response()->json([
    //             'medicines' => new MedicineCollection($medicines)
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'no match was found'
    //         ]);
    //     }
    // }



    //     public function search(Request $request){
    //     try {
    //         $validator=Validator::make($request->all(),[
    //             'search'=>'required'
    //         ]);
    //         if($validator->fails()){
    //             return response()->json($validator->errors(),422);
    //         }
    //         $search = $request->input('search');
    //         $name=DB::select('select * from medicines');
    //         // $name = Medicine::where('commercial_name', 'like', '%' . $search . '%')->get();
    //         // $category = Medicine::where('category', 'like', '%' . $search . '%')->get();

    //         return response()->json([
    //             'Name' => $name,
    //             // 'Category' => new MedicineCollection($category)
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 400);
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        $warehouse = Auth::user();
        $medicine = $warehouse->medicines->where('commercial_name', $request->commercial_name)->first();
        if ($medicine !== null) {
            $quantity = $medicine->quantity + $request->quantity;
            $medicine->update([
                'quantity' => $quantity,
                'price' => $request->price
            ]);
            return response()->json([
                'message' => 'medicine has been added',
                'medicine' => new MedicineResource($medicine)
            ]);
        } else {
            $category = MedicineCategory::find($request->medicine_category_id);
            $medicine = Medicine::create(array_merge(['warehouse_id' => 1, 'category' => $category->category], $request->all()));
            return response()->json([
                'message' => 'medicine has been added',
                'medicine' => new MedicineResource($medicine)
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        try {
            if ($medicine !== null) {
                return response()->json([
                    'medicine' => new MedicineResource($medicine),
                ]);
            } else {
                return response()->json([
                    'message' => 'Medicine was not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing the request.',
            ], 500); // Internal Server Error
        }
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}
