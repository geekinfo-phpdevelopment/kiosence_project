<?php

namespace App\Http\Controllers;

use App\Models\HeadQuarters;
use Illuminate\Http\Request;

class HeadQuartersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headQuarters = HeadQuarters::all();
        return view('HQ.list', ['hqs' => $headQuarters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $headQuarters = new HeadQuarters();
        $headQuarters->name = $request->input('name');
        $headQuarters->place = $request->input('place');
        $headQuarters->save();
        return to_route('hq.index')->with('message', 'Head Quarters Added Sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $headQuarters = HeadQuarters::all();
        $quarters= HeadQuarters::find($id);
        return view('HQ.edit', ['hqs' => $headQuarters, 'quarters'=> $quarters]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $headQuarters = HeadQuarters::find($id);
        $headQuarters->name = $request->input('name');
        $headQuarters->place = $request->input('place');
        $headQuarters->save();
        return to_route('hq.index')->with('message', 'Head Quarters Updated Sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
