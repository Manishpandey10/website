<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colorData = Color::all();
        // dd($colorData);
        return view('admin.color.manageColor', compact('colorData'));
    }
    public function show()
    {
        return view('admin.color.addNewColor');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'colorname' => 'required',
                'colorcode' => 'required',
                // 'status' => 'required|in:0,1'
            ],
            [
                'colorname.required' => 'Enter Color name field is required.',
                'colorcode.required' => 'Enter color code field is required.',
                // 'status.required' => 'Status field is required.',
            ]
        );

        $newColor = new Color();
        $newColor->name = $request->colorname;
        $newColor->colorCode = $request->colorcode;
        // dd($newColor);
        $newColor->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New Color  has been added.',
                'redirect_url' => route('manage.color')
            ]);
        }

        return redirect()->route('manage.color')->with('colorAdded', 'New Color has been added');
    }
    public function edit($id)
    {
        $editData = Color::find($id);
        // dd($editData);

        return view('admin.color.editColor', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'colorname' => 'required',
                'colorcode' => 'nullable',
            ],
            [
                'colorname.required' => 'Enter Color name field is required.',
            ]
        );
        $updateColor = Color::find($id);
        $updateColor->name = $request->colorname;
        $updateColor->colorCode = $request->colorcode;

        // dd($updateColor);
        $updateColor->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => ' color details has been updated',
                'redirect_url' => route('manage.color')
            ]);
        }
        return redirect()->route('manage.color')->with('colorUpdated', "color details has been updated.");
    }

    public function delete($id)
    {
        $data = Color::find($id);
        // dd($data);

        $data->delete();
        return redirect()->back()->with('colorDeleted', "The color has been deleted.");
    }
}
