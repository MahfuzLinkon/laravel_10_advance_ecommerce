<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'crated_by',
        'updated_by',
    ];

    public static function updateOrCreateSubCategory($request, $id = null){
        SubCategory::updateOrCreate(['id' => $id], [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => join('-', explode(' ', strtolower($request->name))),
            'description' => $request->description,
            'image' => uploadImage($request->file('image'), 'admin/upload/sub-category/', isset($id) ? SubCategory::find($id)->image : ''),
            'crated_by' => isset($id) ? SubCategory::find($id)->crated_by : Auth::guard('admin')->user()->id,
            'updated_by' => isset($id) ? Auth::guard('admin')->user()->id : null,
        ]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
