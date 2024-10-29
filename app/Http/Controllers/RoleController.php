<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()->get();
        return view('Role.list', ['roles' => $roles]);
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
        $role = new Role();
        $role->name = $request->input('role');
        $role->save();
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::query()->get();
        $role = Role::find($id);
        return view('Role.edit', ['roles' => $roles,'edit_role'=>$role]);
    }
    public function disable(string $id)
    {
        $role = Role::find($id);
        $role->status = 0;
        $role->save();
        return back();
    }
    public function enable(string $id)
    {
        $role = Role::find($id);
        $role->status = 1;
        $role->save();
        return back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role=Role::find($id);
        $role->name = $request->input('role');
        $role->save();
        return to_route('role.index')->with('message', 'Role updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::find($id);
        $role->delete();
        return to_route('role.index')->with('message', 'Role deleted Sucessfully');
    }
}
