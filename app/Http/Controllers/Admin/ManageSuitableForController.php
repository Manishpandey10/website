<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuitableFor;
use Illuminate\Http\Request;

class ManageSuitableForController extends Controller
{
    public function index()
    {
        $suitabledata = SuitableFor::all();
        return view('admin.suitablefor.manageSuitableFor', compact('suitabledata'));
    }
    public function add()
    {
        return view('admin.suitablefor.addNewSuitable');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'suitableFor_icon' => 'required'
            ],
            [
                'name.required' => 'Name field is required.',
                'suitableFor_icon.required' => 'Upload Thumbnail field is required.',

            ]
        );

        $newData = new SuitableFor();
        $newData->name = $request->name;
        if ($file = $request->File('suitableFor_icon')) {
            $extension = $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-' . uniqid() . '.' . $extension;
            $file->move(public_path('/SuitableFor'), $filename);
            $newData->thumbnail = $filename;
        }

        // dd($newData);
        $newData->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New Suitable for category added.',
            ]);
        }

        return redirect()->route('manage.suitable.for')->with('SuitableForAdded', 'New Suitable for category added');
    }
    public function edit($id)
    {
        $editData = SuitableFor::find($id);
        return view('admin.suitablefor.editSuitable', compact('editData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'suitableFor_icon' => 'nullable'
        ]);
        $updateData = SuitableFor::find($id);

        $updateData->name = $request->name;

        if ($file = $request->File('suitableFor_icon')) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-' . uniqid() . '.' . $extension;
            $file->move(public_path('/SuitableFor'), $filename);
            $updateData->thumbnail = $filename;
        }
        // dd($updateData);

        $updateData->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Suitable for tag details has been updated.',
                'redirect_url'=>route('manage.suitable.for')
            ]);
        }

        return redirect()->route('manage.suitable.for')->with('SuitableForUpdated', 'Suitable for tag details has been updated.');
    }
}
