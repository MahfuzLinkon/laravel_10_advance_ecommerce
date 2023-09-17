<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'slug',
        'description',
        'crated_by',
        'updated_by',
    ];

    public static function updateOrCreateUnit($request, $id = null){
        Unit::updateOrCreate(['id' => $id], [
            'name' => $request->name,
            'code' => $request->code,
            'slug' => join('-', explode(' ', strtolower($request->name))),
            'description' => $request->description,
            'crated_by' => isset($id) ? Unit::find($id)->crated_by : Auth::guard('admin')->user()->id,
            'updated_by' => isset($id) ? Auth::guard('admin')->user()->id : null,
        ]);
    }
}
