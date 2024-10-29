<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::query()->get();
        $role = Role::query()->get();
        $permission = Permission::query()
            ->where('role_id', '=', $role[0]->id)
            ->get();
        return view('Permission.list', ['roles' => $role, 'modules' => $modules, 'permissions' => $permission]);
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
        print_r($request->input());
        $modules = Module::query()->get();
        foreach ($modules as $module) {
            $read = $request->input('read');
            $create = $request->input('create');
            $update = $request->input('update');
            $delete = $request->input('delete');
            $permission = Permission::query()
                ->where('role_id', '=', $request->input('role'))
                ->where('module_id', '=', $module->id)
                ->first();
            if ($permission == null) {
                $permission = new Permission();
                $permission->module_id = $module->id;
                $permission->role_id = $request->input('role');
            }
            if (isset($read[$module->id])) {
                $permission->read = 1;
            } else {
                $permission->read = 0;
            }
            if (isset($create[$module->id])) {
                $permission->write = 1;
            } else {
                $permission->write = 0;
            }
            if (isset($update[$module->id])) {
                $permission->edit = 1;
            } else {
                $permission->edit = 0;
            }
            if (isset($delete[$module->id])) {
                $permission->delete = 1;
            } else {
                $permission->delete = 0;
            }
            $permission->save();
        }
        return to_route('permission.index')->with('message', 'Permission Updated Sucessfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function get_permissions(Request $request)
    {
        $modules = Module::all();
        $permissions = Permission::query()
            ->where('role_id', '=', $request->input('role'))
            ->get();
        // print_r($permissions);exit;
        foreach ($modules as $module) {
            $permission = null;
            foreach ($permissions as $permission1) {
                if ($permission1->module_id == $module->id) {
                    $permission = $permission1;
                }
            }
            echo '<tr><td class="py-1">' . $module->name . '</td> <td><input type="checkbox" name="read[' . $module->id . ']" class="form-check-input" ';
            if ($permission != null) {
                if ($permission->read == 1) {
                    echo 'checked';
                }
            }
            echo '  ></td> <td><input type="checkbox" name="create[' . $module->id . ']" class="form-check-input" ';
            if ($permission != null) {
                if ($permission->write == 1) {
                    echo 'checked';
                }
            }
            echo '></td><td><input type="checkbox" name="update[' . $module->id . ']" class="form-check-input" ';
            if ($permission != null) {
                if ($permission->edit == 1) {
                    echo 'checked';
                }
            }
            echo '></td><td><input type="checkbox" name="delete[' . $module->id . ']" class="form-check-input"';
            if ($permission != null) {
                if ($permission->delete == 1) {
                    echo 'checked';
                }
            }
            echo '></td> </tr>';
        }
    }
}
