<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('users.id', 'users.name', 'users.email', 'users.status', 'roles.name as role', 'staff.mobile')
            ->join('roles', 'roles.id', "=", 'users.role_id')
            ->join('staff', 'staff.user_id', "=", 'users.id')
            ->get();
        return view('User.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::query()
            ->get();
        return view('User.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required',
            'joining_date' => 'required|date_format:d/m/Y',
            'email' => 'required|email',
            'mobile' => 'required|max:13|min:10',
            'gender' => 'required',
            'dob' => 'required|date_format:d/m/Y',
            'role' => 'required',
            'adrl1' => 'required',
            'adrl2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $user = new User();
            $user->name = $request->input('first_name') . " " . $request->input('last_name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->save();

            $staff = new Staff();
            $staff->user_id = $user->id;
            $staff->employee_id = $request->input('employee_id');
            $join_date = Carbon::createFromFormat('d/m/Y', $request->input('joining_date'))->format('Y-m-d');
            $staff->joining_date = $join_date;
            $dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d');
            $staff->dob = $dob;
            $staff->mobile = $request->input('mobile');
            $staff->gender = $request->input('gender');
            $staff->adr_ln1 = $request->input('adrl1');
            $staff->adr_ln2 = $request->input('adrl2');
            $staff->city = $request->input('city');
            $staff->pincode = $request->input('pincode');
            $staff->state = $request->input('state');
            $staff->save();
            return to_route('users.index')->with('message', 'User Added Sucessfully!');
        }
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
        $roles = Role::query()
            ->get();
        $user = User::select('users.id', 'users.name', 'users.email', 'users.role_id', 'staff.mobile', 'staff.employee_id', 'staff.joining_date', 'staff.dob', 'staff.gender', 'staff.adr_ln1', 'staff.adr_ln2', 'staff.city', 'staff.state', 'staff.pincode')
            ->join('staff', 'staff.user_id', "=", 'users.id')
            ->find($id);
        return view('User.edit', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required',
            'joining_date' => 'required|date_format:d/m/Y',
            'email' => 'required|email',
            'mobile' => 'required|max:13|min:10',
            'gender' => 'required',
            'dob' => 'required|date_format:d/m/Y',
            'role' => 'required',
            'adrl1' => 'required',
            'adrl2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $user = User::find($id);
            $user->name = $request->input('first_name') . " " . $request->input('last_name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->save();

            $staff = Staff::select()
                ->where('user_id', $user->id)
                ->first();
            $staff->employee_id = $request->input('employee_id');
            $join_date = Carbon::createFromFormat('d/m/Y', $request->input('joining_date'))->format('Y-m-d');
            $staff->joining_date = $join_date;
            $dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d');
            $staff->dob = $dob;
            $staff->mobile = $request->input('mobile');
            $staff->gender = $request->input('gender');
            $staff->adr_ln1 = $request->input('adrl1');
            $staff->adr_ln2 = $request->input('adrl2');
            $staff->city = $request->input('city');
            $staff->pincode = $request->input('pincode');
            $staff->state = $request->input('state');
            $staff->save();
            return to_route('users.index')->with('message', 'User Updated Sucessfully!');
        }
    }
    public function disable(string $id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return to_route('users.index')->with('message', 'User Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return to_route('users.index')->with('message', 'User enabled Sucessfully');
    }

    public function destroy(string $id)
    {
        $staff=Staff::query()->where('user_id',$id)->first();
        $staff->delete();
        $user=User::find($id);
        $user->delete();
        return to_route('users.index')->with('message', 'User deleted Sucessfully');
    }
}
