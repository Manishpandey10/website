<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaxSlab;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Http\Request;

class ManageTaxController extends Controller
{
    public function index(){
        $taxData = TaxSlab::all();
        return view('admin.taxes.manageTaxes',compact('taxData'));
    }
    public function show(){
        return view('admin.taxes.addNewTaxSlab');
    }
    public function store(Request $request){
        $request->validate([
            'slabRateCode'=>'required',
            'pricelimit'=>'required',
            'minTax'=>'required|in:1,2,3,4,5,6,7',
            'maxTax'=>'required|in:1,2,3,4,5,6,7',
        ]);

        $newTaxSlab = new TaxSlab();

        $newTaxSlab->name = $request->slabRateCode;
        $newTaxSlab->pricelimit = $request->pricelimit;
        $newTaxSlab->minTax = $request->minTax;
        $newTaxSlab->maxTax = $request->maxTax;

        // dd($newTaxSlab);
        $newTaxSlab->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New GST Tax slab rate is added.',
                'redirect_url' => route('manage.tax')
            ]);
        }
        return redirect()->route('manage.tax')->with('taxAdded','New GST Tax slab rate is added');
    }
    public function edit($id){
        $editData = TaxSlab::find($id);
        // dd($editData);
        return view('admin.taxes.editTaxSlab',compact('editData'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'slabRateCode'=>'required',
            'priceLimit'=>'required',
            'minTax'=>'required|in:1,2,3,4,5,6,7',
            'maxTax'=>'required|in:1,2,3,4,5,6,7',
        ]);

        $updatedTaxSlab = TaxSlab::find($id);
        $updatedTaxSlab->name = $request->slabRateCode;
        $updatedTaxSlab->pricelimit = $request->pricelimit;
        $updatedTaxSlab->minTax = $request->minTax;
        $updatedTaxSlab->maxTax = $request->maxTax;

        // dd($updatedTaxSlab);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New GST Tax slab rate is added.',
                'redirect_url' => route('manage.tax')
            ]);
        }

        return redirect()->route('manage.tax')->with('taxUpdated','GST Tax slab rate details has been changed');
    }
}
