<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $typeData = ProductType::all();

        // return response()->json([
        //     'msg'=>'Types of products',
        //     'data'=>$typeData,
        // ]);


        return view('admin.productTypes.manageType', compact('typeData'));
    }
    
    public function show()
    {
        return view('admin.productTypes.addNewProductType');
    }
    // public function store(Request $request){
    //     $request->validate(
    //          [
    //             'productType' => 'required',
    //             'size'=>'required',
    //         ],
    //         [
    //             'productType.required' => 'Enter Color name field is required.',
    //             'size.required' => 'Status field is required.',
    //         ]
    //         );
    //         $newType = new ProductType();
    //         $newType->name = $request->productType;
    //         $selectedOptions = $request->size;
    //         $sizedata = implode(',',$selectedOptions);
    //         $newType->size = $sizedata;
    //         // dd($newType);

    //         $newType->save();
    //         return redirect()->route('manage.types')->with('typeAdded','New Product type has been added.');

    // }
    public function edit($id)
    {
        $editData = ProductType::find($id);
        // dd($editData);
        $data = explode(',', $editData->size);
        // dd($data);


        return view('admin.productTypes.editType', compact('editData', 'data'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productType' => 'required',
            'size' => 'required',
        ], [
            'productType.required' => 'Product type field is required.',
            'size.required' => 'Sizes field is required.',
        ]);

        $newType = new ProductType();
        $newType->name = $request->productType;
        $newType->size = implode(',', $request->size);
        $newType->save();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'New product type has been added successfully.',
                'redirect_url' => route('manage.types')
            ]);
        }
        return redirect()->route('manage.types')->with('typeAdded', 'New Product type has been added.');
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'productType' => 'required',

            ],
            [
                'productType.required' => 'Enter Color name field is required.',
 
            ]
        );
        $updateType = ProductType::find($id);
        $updateType->name = $request->productType;
        $updateType->size = implode(',', $request->size);


        // dd($updateType);
        $updateType->save();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'product type details has been updated.',
                'redirect_url' => route('manage.types')
            ]);
        }
        return redirect()->route('manage.types')->with('typeUpdated', "product type details has been updated.");
    }
    public function delete($id)
    {
        $data = ProductType::find($id);
        $data->delete();

        return redirect()->back()->with('typeDeleted', "product type has been deleted.");
    }
}
