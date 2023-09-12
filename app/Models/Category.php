<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
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

    public static function updateOrCreateCategory($request, $id = null){
        Category::updateOrCreate(['id' => $id], [
           'name' => $request->name,
           'slug' => join('-', explode(' ', strtolower($request->name))),
           'description' => $request->description,
           'image' => uploadImage($request->file('image'), 'admin/upload/category/', isset($id) ? Category::find($id)->image : ''),
            'crated_by' => isset($id) ? Category::find($id)->crated_by : Auth::guard('admin')->user()->id,
            'updated_by' => isset($id) ? Auth::guard('admin')->user()->id : null,
        ]);
    }







}
