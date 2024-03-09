<?php

namespace App\Http\Controllers;

use App\Models\UtilityPoll;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilityPollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $utilityPolls = UtilityPoll::latest()->with(['routeLine','createdBy','updatedBy'])->get();
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
            'pole' => ['required',Rule::unique('utility_polls','pole')],
            'line' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'route_lines' => ['required'],
        ]);

        $data = [
            'pole' => $request->pole,
            'line' => $request->line ?? "up-line",
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description ?? "no description",
            'status' => $request->status ?? true,
            'route_line_id' => $request->route_lines ??1,
            'created_by' => auth()->user()->id,
        ];

        try {
           UtilityPoll::create($data);
            return redirect()->route('utility-polls.index')->with('success', 'Utility Poll created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UtilityPoll $utilityPoll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UtilityPoll $utilityPoll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UtilityPoll $utilityPoll)
    {
        $request->validate([
            'pole' => ['required',Rule::unique('utility_polls','pole')->ignore($utilityPoll->id)],
            'line' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'route_lines' => ['required'],
        ]);

        $data = [
            'pole' => $request->pole,
            'line' => $request->line,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'status' => $request->status,
            'route_line_id' => $request->route_lines,
            'updated_by' => auth()->user()->id,
        ];

        try {
           $utilityPoll->update($data);
            return redirect()->route('utility-polls.index')->with('success', 'Utility Poll Update successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UtilityPoll $utilityPoll)
    {
        try {
            $utilityPoll->delete();
            return redirect()->back()->with('success', 'Utility Poll Delete successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', $th->getMessage());
        }
    }
}
