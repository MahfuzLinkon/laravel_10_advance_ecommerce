<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index',[
            'products' => Product::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::where('status', 1)->get(),
            'brands' => Brand::where('status', 1)->get(),
            'units' => Unit::where('status', 1)->get(),
        ]);
    }

    public function getSubcategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->categoryId)->get();
        return response()->json($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
            'stock_amount' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
            'short_description' => 'required',
            'image' => 'required',
        ]);

        Product::updateOrCreatedProduct($request);
        return redirect()->back()->with('success', 'Product Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit',[
            'product' => $product,
            'categories' => Category::where('status', 1)->get(),
            'subCategories' => SubCategory::where('status', 1)->get(),
            'brands' => Brand::where('status', 1)->get(),
            'units' => Unit::where('status', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'name' => ['required', Rule::unique('products')->ignore($product->id)],
            'code' => ['required', Rule::unique('products')->ignore($product->id)],
            'stock_amount' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
            'short_description' => 'required',
        ]);

        Product::updateOrCreatedProduct($request, $product->id);
        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully!');
    }

    public function status(Product $product)
    {
        if ($product->status === 1){
            $product->status = 0;
            $message = 'Product Unpublished!';
        }else{
            $product->status = 1;
            $message = 'Product Published!';
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image ){
            if (file_exists($product->image )){
                unlink($product->image );
            }
        }
        if ($product->other_images){
            if (file_exists($product->other_images)){
                unlink($product->other_images);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
