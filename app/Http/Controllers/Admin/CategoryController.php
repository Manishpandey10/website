<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\confirm;

class CategoryController extends Controller
{
    public function index()
    {
        // $categoryData = Category::all();
        $categoryData = Category::with('parents')->get();//returns all category fields with parent relation arrays

        // $categoryData = Category::with('subcategory')->has('subcategory')->get(); // gets all the data in category table with relation array //used it for api testing**
       
       
        // $categoryData = Category::with('subcategory')->get()->filter(function($category){
        //     return $category->subcategory->isNotEmpty();
        // });
        

        // return response()->json([
        //     'msg' => 'category data fetched with subcategory relation array ',
        //     'data' => $categoryData,
        // ]);

        // dd($categoryData);
        return view('admin.category.manageCategory', compact('categoryData'));
    }

    public function show()
    {
        // $categoryData = Category::with('subcategory')->whereDoesntHave('subcategory')->get();// filters out and gives all those fields which are not parent 
        $categoryData = Category::whereHas('subcategory')->with('subcategory')->get(); // filters out and gives all the category other than children category
        // $categoryData = Category::with('subcategory')->get();// gets all the data in category table with relation array
        // dd($categoryData);
        // dd($data);

        // dd($categoryData);

        return view('admin.category.addNewCategory', compact('categoryData'));
    }

    //for handling th enew category submission
    public function storeCategory(Request $request)
    {
        $request->validate(
            [
                'categoryname' => 'required',
                'category_thumbnail' => 'nullable|image|mimes:png,jpg,jpeg',
                'parentCategory' => 'nullable',
                'metaTitle' => 'required',
                'metaDescription' => 'required',
                'productStatus' => 'required|in:0,1'

            ],
            [
                'categoryname.required' => 'Product Category name field is required.',
                'category_thumbnail.required' => 'Thumbnail field is required.',
                'parentCategory.required' => 'Select Product Category field is required.',
                'metaTitle.required' => 'Enter meta title field is required.',
                'metaDescription.required' => 'Enter meta description field is required.',
                'category_thumbnail.mimes' => 'File uploaded is not supported.',
                'productStatus.required' => 'Status field is required.',
            ]
        );
        // saving the new category 

        $newCategory = new Category();
        $newCategory->name = $request->categoryname;

        $newCategory->parent_id = $request->parentCategory;
        $newCategory->metaTitle = $request->metaTitle;
        $newCategory->metaDescription = $request->metaDescription;

        if ($request->hasFile('category_thumbnail')) {
            $newCategory->category_image = $request->file('category_thumbnail')->store('CategoryThumbnail', 'public');
        }

        $newCategory->status = $request->productStatus;

        $newCategory->save();
        // dd($newCategory);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New product category has been added.',
            ]);
        }

        // return response()->json([
        //     'status'=>'true',
        //     'data'=>$newCategory,
        //     'msg'=>"New Product Category has been added."
        // ]);
        return redirect()->route('manage.category')->with('newCategory', 'New product category has been added');
    }
    //
    public function edit($id)
    {
        $categoryEditData = Category::find($id);
        // $categoryData = Category::all();
        $categoryData = Category::whereHas('subcategory')->with('subcategory')->get();

        // dd("id opf the category is ",$categoryEditData->id);
        // dd(gettype($categoryEditData->id));//confirms its a integer....
        // dd($categoryData);
        // dd($categoryEditData);
        return view('admin.category.editCategory', compact('categoryEditData', 'categoryData'));
    }
    //for handling the edit category submissition
    public function updateCategory(Request $request, $id)
    {
        $request->validate(
            [
                'categoryname' => 'required',
                'category_thumbnail.*' => 'nullable|image|mimes:png,jpg,jpeg',
                // 'parentCategory' => 'nullable',
                'metaTitle' => 'required',
                'metaDescription' => 'required',
                'productStatus' => 'required|in:0,1'

            ],
            [
                'categoryname.required' => 'Product Category name field is required.',
                'category_thumbnail.required' => 'Thumbnail field is required.',
                // 'parentCategory.required' => 'Select Product Category field is required.',
                'metaTitle.required' => 'Enter Meta Title field is required',
                'metaDescription.required' => 'Enter Meta Description field is required',
                'category_thumbnail.mimes' => 'File uploaded is not supported.',
                'productStatus.required' => 'Status field is required.',
            ]
        );
        $updateCategory = Category::find($id);
        $updateCategory->name = $request->categoryname;
        if ($request->hasFile('category_thumbnail')) {
            $request->category_image = $request->file('category_thumbnail')->store('categorythumbnailUpdated', 'public');
        }
        // $updateCategory->parent_category = $request->parentCategory;
        $updateCategory->metaTitle = $request->metaTitle;
        $updateCategory->metaDescription = $request->metaDescription;
        $updateCategory->status = $request->productStatus;
        // dd($updateCategory);
        $updateCategory->save();


        return redirect()->route('manage.category')->with('categoryUpdated', 'Category details has been updated.');
    }

    public function delete($id)
    {
        $data = Category::find($id);
        // dd($data);

        $data->delete();
        return redirect()->route('manage.category')->with('CategoryDeleted', ' product category has been deleted');
    }
}
