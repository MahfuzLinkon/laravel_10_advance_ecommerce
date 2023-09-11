<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|unique:categories',
           'description' => 'required',
        ]);
        Category::updateOrCreateCategory($request);
        return redirect()->back()->with('success', 'Category Crated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category->id)],
            'description' => 'required',
        ]);
        Category::updateOrCreateCategory($request, $category->id);
        return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfully');
    }

    public function status(Category $category)
    {
        if ($category->status === 1){
            $category->status = 0;
            $message = 'Category Unpublished!';
        }else{
            $category->status = 1;
            $message = 'Category Published!';
        }
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image){
            if (file_exists($category->image)){
                unlink($category->image);
            }
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfully');
    }
}
