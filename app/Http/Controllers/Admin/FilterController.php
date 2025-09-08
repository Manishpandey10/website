<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(){
          $filters = Filter::all();
        //   return response()->json([
        //     'msg'=>'All the available filters ',
        //     'Filterdata'=>$filters,
        //   ]);
        // dd($filters);
        return view('admin.filter.manageFilter',compact('filters'));
    }
    public function show(){
      
        return view('admin.filter.addNewFilter');
    }
    public function store(Request $request){
        $request->validate(
           [
                'filtername' => 'required',
            ],
            [
                'filtername.required' => 'Product Filter name field is required.',
            ]);

            $newFilter = new Filter();
            $newFilter->name = $request->filtername;
            // $newFilter->slug = $request->slug;
           
            // dd($newFilter);
            $newFilter->save();
             if ($request->ajax()) {
            return response()->json([
                'message' => 'New Filter has been added.',
            ]);
        }
            return redirect()->route('manage.filter')->with('FilterAdded', "New Filter has been added.");
    }

    public function edit($id){
        $editData = Filter::find($id);
        // $filterData = Filter::all();
        // dd($editData);
        return view('admin.filter.editFilter',compact('editData'));
    }
    public function update(Request $request, $id){
        $request->validate(
           [
                'filtername' => 'required',
                

            ],
            [
                'filtername.required' => 'Product Category name field is required.',
                
            ]);
            $updatedFilter = Filter::find($id);
            // dd($updatedFilter);/
            $updatedFilter->name = $request->filtername;
         
            
            // dd($updatedFilter);
            $updatedFilter->save();
            return redirect()->route('manage.filter')->with('FilterUpdated', 'Filter details has been updated.');
    }

    public function delete($id){
        $deleteData = Filter::find($id);

        // dd($deleteData);

        $deleteData->delete();
        return redirect()->route('manage.filter')->with('FilterDeleted','Filter has been deleted.');
    }
}
