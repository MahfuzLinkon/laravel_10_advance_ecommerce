<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sub-category.index',[
            'subCategories' => SubCategory::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sub-category.create',[
            'categories' => Category::where('status', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories',
            'category_id' => 'required',
            'description' => 'required',
        ],[
            'category_id.required' => 'The category name field is required.',
        ]);
        SubCategory::updateOrCreateSubCategory($request);
        return redirect()->back()->with('success', 'SubCategory Crated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        return view('admin.sub-category.edit',[
            'categories' => Category::where('status', 1)->get(),
            'subCategory' => $subCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name' => ['required',
                Rule::unique('sub_categories')->ignore($subCategory->id)],
            'category_id' => 'required',
            'description' => 'required',
        ],[
            'category_id.required' => 'The category name field is required.',
        ]);
        SubCategory::updateOrCreateSubCategory($request, $subCategory->id);
        return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory Updated Successfully');
    }

    public function status(SubCategory $subcategory)
    {
        if ($subcategory->status === 1){
            $subcategory->status = 0;
            $message = 'SubCategory Unpublished!';
        }else{
            $subcategory->status = 1;
            $message = 'SubCategory Published!';
        }
        $subcategory->save();
        return redirect()->route('admin.sub-categories.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        if ($subCategory->image){
            if (file_exists($subCategory->image)){
                unlink($subCategory->image);
            }
        }
        $subCategory->delete();
        return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory Deleted Successfully');
    }
}
