<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'crated_by',
        'updated_by',
    ];

    public static function updateOrCreateBrand($request, $id = null){
        Brand::updateOrCreate(['id' => $id], [
            'name' => $request->name,
            'slug' => join('-', explode(' ', strtolower($request->name))),
            'description' => $request->description,
            'image' => uploadImage($request->file('image'), 'admin/upload/brand/', isset($id) ? Brand::find($id)->image : ''),
            'crated_by' => isset($id) ? Brand::find($id)->crated_by : Auth::guard('admin')->user()->id,
            'updated_by' => isset($id) ? Auth::guard('admin')->user()->id : null,
        ]);
    }
}
