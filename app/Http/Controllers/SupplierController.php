<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('supplier.list', ['suppliers' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
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
            'contact_name' => 'required',
            'contact_mobile' => 'required|max:13|min:10',
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
            $supplier = new Supplier();
            $supplier->name = $request->input('name');
            $supplier->email = $request->input('email');
            $supplier->mobile = $request->input('mobile');
            $supplier->contact_person = $request->input('contact_name');
            $supplier->contact_mobile = $request->input('contact_mobile');
            $supplier->adr_ln1 = $request->input('adrl1');
            $supplier->adr_ln2 = $request->input('adrl2');
            $supplier->city = $request->input('city');
            $supplier->pincode = $request->input('pincode');
            $supplier->state = $request->input('state');
            $supplier->save();
            return to_route('supplier.index')->with('message', 'Supplier Added Sucessfully!');
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
        $supplier =Supplier::find($id);
        return view('supplier.edit',['supplier'=>$supplier]);
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
            'contact_name' => 'required',
            'contact_mobile' => 'required|max:13|min:10',
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
            $supplier =Supplier::find($id);
            $supplier->name = $request->input('name');
            $supplier->email = $request->input('email');
            $supplier->mobile = $request->input('mobile');
            $supplier->contact_person = $request->input('contact_name');
            $supplier->contact_mobile = $request->input('contact_mobile');
            $supplier->adr_ln1 = $request->input('adrl1');
            $supplier->adr_ln2 = $request->input('adrl2');
            $supplier->city = $request->input('city');
            $supplier->pincode = $request->input('pincode');
            $supplier->state = $request->input('state');
            $supplier->save();
            return to_route('suppliers.index')->with('message', 'Supplier Updated Sucessfully!');
        }
    }
    public function disable(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->status = 0;
        $supplier->save();
        return to_route('suppliers.index')->with('message', 'Supplier Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->status = 1;
        $supplier->save();
        return to_route('suppliers.index')->with('message', 'Supplier enabled Sucessfully');
    }

    public function destroy(string $id)
    {
        $supplier=Supplier::find($id);
        $supplier->delete();
        return to_route('suppliers.index')->with('message', 'Supplier deleted Sucessfully');
    }
}
