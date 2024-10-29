<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategory;
use App\Models\Medicines;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicines::query()->get();

        return view('Medicine.list', ['medicines' => $medicines]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MedicineCategory::all();
        return view('Medicine.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $rule = array(
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'content' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required'
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $medicine = new Medicines();
            $medicine->name = $request->input('name');
            $medicine->brand = $request->input('brand');
            $medicine->medicine_category_id = $request->input('category');
            $medicine->content = $request->input('content');
            $medicine->amount = $request->input('amount');
            $medicine->description = $request->input('description');
            $medicine->save();
            return to_route('medicines.index')->with('message', 'Medicines Added Sucessfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicine = Medicines::find($id);
        $categories = MedicineCategory::all();
        return view('Medicine.edit', ['categories' => $categories, 'medicine' => $medicine]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        $rule = array(
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'content' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required'
        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $medicine = Medicines::find($id);
            $medicine->name = $request->input('name');
            $medicine->brand = $request->input('brand');
            $medicine->medicine_category_id = $request->input('category');
            $medicine->content = $request->input('content');
            $medicine->amount = $request->input('amount');
            $medicine->description = $request->input('description');
            $medicine->save();
            return to_route('medicines.index')->with('message', 'Medicine Updated Sucessfully!');
        }
    }

    public function disable(string $id)
    {
        $user = Medicines::find($id);
        $user->status = 0;
        $user->save();
        return to_route('medicines.index')->with('message', 'Medicine Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $user = Medicines::find($id);
        $user->status = 1;
        $user->save();
        return to_route('medicines.index')->with('message', 'Medicine enabled Sucessfully');
    }
    public function destroy(string $id)
    {
        //
    }
}
