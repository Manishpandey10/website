<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class ManageTagsController extends Controller
{
    public function index(){
        $tagData = Tag::all();

        // dd($tagData);
        return view('admin.tags.manageTags',compact('tagData'));
    }
    public function show(){
        return view('admin.tags.addNewTags');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'status'=>'required|in:0,1'
        ],[
            'name.required'=>'Tag Name field is required',
            'status.required'=>'Status field is required',
        ]);
        $newTag = new Tag();
        $newTag->name = $request->name;
        $newTag->status = $request->status;

        // dd($newTag);
        $newTag->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New Hsn Code has been added.',
                'redirect_url' => route('manage.tags')
            ]);
        }
        return redirect()->route('manage.tags')->with('TagAdded','New Tag is created');
    }
    public function edit($id){
        $editData = Tag::find($id);
        return view('admin.tags.editTags', compact('editData'));
    }
    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required',
            'status'=>'required|in:0,1'
        ],[
            'name.required'=>'Tag Name field is required',
            'status.required'=>'Status field is required',
        ]);
        $updateTag = Tag::find($id);
        $updateTag->name=$request->name;
        $updateTag->status = $request->status;

        // dd($updateTag);
        $updateTag->save();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Tag details has been updated.',
                'redirect_url' => route('manage.tags')
            ]);
        }

        return redirect()->route('manage.tags')->with('TagUpdated','Tag details has been updated.');
    }
}
