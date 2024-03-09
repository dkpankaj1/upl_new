<?php

namespace App\Http\Controllers;

use App\Models\RouteLine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RouteLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Inertia::render('RouteLines/Index', ['routeLines' => RouteLine::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return Inertia::render('RouteLines/Create', ['zonals' => Zonal::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('route_lines', 'name')],
            'zonal' => ['required'],
            'description' => ['required'],
        ]);

        try {
            RouteLine::create([
                'zonal_id' => $request->zonal,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]);
            return redirect()->route('route-lines.index')->with('success', 'Route Lines created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RouteLine $route_line)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RouteLine $route_line)
    {
        // return Inertia::render('RouteLines/Edit', ['zonals' => Zonal::all(),'routeLines' => $route_line]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RouteLine $route_line)
    {
        $request->validate([
            'name' => ['required', Rule::unique('route_lines', 'name')->ignore($route_line->id)],
            'zonal' => ['required'],
            'description' => ['required'],
        ]);

        try {
            $route_line->update([
                'zonal_id' => $request->zonal,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]);
            return redirect()->route('route-lines.index')->with('success', 'Route Lines Update successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RouteLine $route_line)
    {
        //
    }
}
