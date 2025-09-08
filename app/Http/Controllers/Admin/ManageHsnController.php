<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hsn;
use Illuminate\Http\Request;

class ManageHsnController extends Controller
{
    public function index()
    {
        $hsnData = Hsn::all();
        return view('admin.hsn.manageHsn', compact('hsnData'));
    }
    public function show()
    {
        return view('admin.hsn.addNewHsn');
    }
    public function store(Request $request)
    {
        $request->validate([
            'hsncode' => 'required',
        ]);
        $newData = new Hsn();
        $newData->name = $request->hsncode;

        // dd($newData);
        $newData->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New Hsn Code has been added.',
                'redirect_url' => route('manage.types')
            ]);
        }

        return redirect()->route('manage.hsn')->with('hsnAdded', 'New Hsn Code has been added');
    }
    public function edit($id)
    {
        $hsnData = Hsn::find($id);
        return view('admin.hsn.editHsn', compact('hsnData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'hsncode' => 'required',
        ]);
        $updateData = Hsn::find($id);

        $updateData->name = $request->hsncode;
        $updateData->save();
        if ($request->ajax()) {
        return response()->json([
            'message' => 'HSN code details has been changed.',
            'redirect_url' => route('manage.hsn')
        ]);
    }
        return redirect()->route('manage.hsn')->with('hsnUpdated', 'HSN code details has been changed.');
    }
}
