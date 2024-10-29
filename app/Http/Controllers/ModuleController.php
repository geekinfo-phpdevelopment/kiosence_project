<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $modules=Module::query()->get();
       return view('Module.list', ['modules'=>$modules]);
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
       $module=new Module();
       $module->name=$request->input('name');
       $module->slug=$request->input('slug');
       $module->icon=$request->input('icon');
       $module->save();
       return to_route('module.index')->with('message', 'Module Added Sucessfully!');
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
        $modules = Module::query()->get();
        $module = Module::find($id);
        return view('Module.edit', ['modules' => $modules,'edit_module'=>$module]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function disable(string $id)
    {
        $module = Module::find($id);
        $module->status = 0;
        $module->save();
        return back();
    }
    public function enable(string $id)
    {
        $module = Module::find($id);
        $module->status = 1;
        $module->save();
        return back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $module=Module::find($id);
        $module->name = $request->input('module');
        $module->slug=$request->input('slug');
        $module->icon=$request->input('icon');
        $module->save();
        return to_route('module.index')->with('message', 'Module updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module=Module::find($id);
        $module->delete();
        return to_route('module.index')->with('message', 'Module updated Sucessfully');
    }
}
