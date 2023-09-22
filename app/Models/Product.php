<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'unit_id',
        'name',
        'slug',
        'code',
        'model',
        'stock_amount',
        'regular_price',
        'selling_price',
        'short_description',
        'long_description',
        'image',
        'other_images',
        'featured_status',
        'special_offer',
        'crated_by',
        'updated_by',
    ];


    public static function updateOrCreatedProduct($request, $id = null){
        $otherImage = [];
        if ($request->other_images){
            for ($i = 0; $i < count($request->other_images); $i++){
                $otherImage[] = uploadImage($request->file('other_images')[$i], 'admin/upload/product/', isset($id) ? Product::find($id)->other_images : '', 600, 600);
            }
        }


        Product::updateOrCreate(['id' => $id], [
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id' => $request->brand_id,
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'slug' => join('-', explode(' ', strtolower($request->name))),
            'code' => $request->code,
            'model' => $request->model,
            'stock_amount' => $request->stock_amount,
            'regular_price' => $request->regular_price,
            'selling_price' => $request->selling_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => uploadImage($request->file('image'), 'admin/upload/product/', isset($id) ? Product::find($id)->image : '', 600, 600),

            'other_images' => $request->other_images !== null ? implode('|' , $otherImage) : Product::find($id)->other_images ?? null,

            'featured_status' => $request->featured_status,
            'special_offer' => $request->special_offer,
            'status' => $request->status,
            'crated_by' => isset($id) ? Category::find($id)->crated_by : Auth::guard('admin')->user()->id,
            'updated_by' => isset($id) ? Auth::guard('admin')->user()->id : null,
        ]);
    }
}
