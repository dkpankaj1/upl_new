<?php

namespace App\Http\Controllers;

use App\Models\Zonal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:zonals,name'],
            'description' => ['required'],
            'status' => ['required'],
        ]);

        try {
            Zonal::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status
            ]);
            // return redirect()->route('zonals.index')->with('success', 'Zonal created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Zonal $zonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zonal $zonal)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zonal $zonal)
    {
        $request->validate([
            'name' => ['required', Rule::unique('zonals')->ignore($zonal->id)],
            'description' => ['required'],
            'status' => ['required'],
        ]);

        try {
            $zonal->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status
            ]);
            return redirect()->route('zonals.index')->with('success', 'Zonal Update successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zonal $zonal)
    {
        try {
            $zonal->delete();
            return redirect()->back()->with('success', 'Zonal Delete successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', $th->getMessage());
        }
    }
}
