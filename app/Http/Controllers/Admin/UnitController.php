<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.unit.index',[
            'units' => Unit::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units',
            'code' => 'required|unique:units',
            'description' => 'required',
        ]);
        Unit::updateOrCreateUnit($request);
        return redirect()->back()->with('success', 'Unit Crated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit',[
            'unit' => $unit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => [ 'required', Rule::unique('units')->ignore($unit->id)],
            'code' => [ 'required', Rule::unique('units')->ignore($unit->id)],
            'description' => 'required',
        ]);
        Unit::updateOrCreateUnit($request, $unit->id);
        return redirect()->route('admin.units.index')->with('success', 'Unit Updated Successfully');
    }

    public function status(Unit $unit)
    {
        if ($unit->status === 1){
            $unit->status = 0;
            $message = 'Unit Unpublished!';
        }else{
            $unit->status = 1;
            $message = 'Unit Published!';
        }
        $unit->save();
        return redirect()->route('admin.units.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success',  'Unit Deleted Successfully');
    }
}
