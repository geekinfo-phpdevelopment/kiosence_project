<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctors::all();
        return view('Doctors.list', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $rule = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:13|min:10',
            'hospital' => 'required',
            'place' => 'required',
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            // echo"failed"; exit;
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $doctor = new Doctors();
            $doctor->name = $request->input('name');
            $doctor->hospital = $request->input('hospital');
            $doctor->place = $request->input('place');
            $doctor->email = $request->input('email');
            $doctor->mobile = $request->input('mobile');
            $doctor->specialization = $request->input('specialization');
            $doctor->qualification = $request->input('qualification');
            $doctor->save();
            return to_route(route: 'doctors.index')->with('message', 'Doctor Added Sucessfully!');
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
       $doctor=Doctors::find($id);
       return view('Doctors.edit',['doctor'=>$doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        $rule = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:13|min:10',
            'hospital' => 'required',
            'place' => 'required',
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            // echo"failed"; exit;
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $doctor = Doctors::find($id);
            $doctor->name = $request->input('name');
            $doctor->hospital = $request->input('hospital');
            $doctor->place = $request->input('place');
            $doctor->email = $request->input('email');
            $doctor->mobile = $request->input('mobile');
            $doctor->specialization = $request->input('specialization');
            $doctor->qualification = $request->input('qualification');
            $doctor->save();
            return to_route(route: 'doctors.index')->with('message', 'Doctor Updated Sucessfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */public function disable(string $id)
    {
        $doctor = Doctors::find($id);
        $doctor->status = 0;
        $doctor->save();
        return to_route('doctors.index')->with('message', 'Doctor Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $doctor = Doctors::find($id);
        $doctor->status = 1;
        $doctor->save();
        return to_route('doctors.index')->with('message', 'Doctor enabled Sucessfully');
    }

    public function destroy(string $id)
    {
        $doctor=Doctors::find($id);
        $doctor->delete();
        return to_route('doctors.index')->with('message', 'Doctor deleted Sucessfully');
    }
}
