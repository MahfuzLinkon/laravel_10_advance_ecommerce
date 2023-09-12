<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brand.index', [
            'brands' => Brand::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'description' => 'required',
        ]);
        Brand::updateOrCreateBrand($request);
        return redirect()->back()->with('success', 'Brand Crated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',[
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => ['required', Rule::unique('brands')->ignore($brand->id)],
            'description' => 'required',
        ]);
        Brand::updateOrCreateBrand($request, $brand->id);
        return redirect()->route('admin.brands.index')->with('success', 'Brand Update Successfully');
    }

    public function status(Brand $brand)
    {
        if ($brand->status === 1){
            $brand->status = 0;
            $message = 'Brand Unpublished!';
        }else{
            $brand->status = 1;
            $message = 'Brand Published!';
        }
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image){
            if (file_exists($brand->image)){
                unlink($brand->image);
            }
        }
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand Deleted Successfully');
    }
}
