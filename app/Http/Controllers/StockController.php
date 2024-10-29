<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use App\Models\Stocks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stocks::select('stocks.id', 'stocks.quantity', 'medicines.name as medicine', 'stocks.created_at', 'stocks.status')
            ->join('medicines', 'medicines.id', '=', 'stocks.medicines_id')->get();
        $medicines = Medicines::all();
        return view('stocks.list', ['stocks' => $stocks, 'medicines' => $medicines]);
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
        $input = $request->input();
        $rule = array(
            'medicine' => 'required',
            'quantity' => 'required',
            'exp_date' => 'required|date_format:d/m/Y',

        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $exp_date = Carbon::createFromFormat('d/m/Y', $request->input('exp_date'))->format('Y-m-d');
            $stock = new Stocks();
            $stock->medicines_id = $request->input('medicine');
            $stock->quantity = $request->input('quantity');
            $stock->exp_date = $exp_date;
            $stock->save();
            return to_route(route: 'stocks.index')->with('message', 'Stock Added Sucessfully!');
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
      
        $stocks = Stocks::select('stocks.id', 'stocks.quantity', 'medicines.name as medicine', 'stocks.created_at', 'stocks.status')
            ->join('medicines', 'medicines.id', '=', 'stocks.medicines_id')->get();
        $medicines = Medicines::all();
        $stock= Stocks::find($id);
        // print_r($stock); exit;
        return view('stocks.edit', ['stocks' => $stocks, 'medicines' => $medicines, 'stock'=>$stock]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        $rule = array(
            'medicine' => 'required',
            'quantity' => 'required',
            'exp_date' => 'required|date_format:d/m/Y',

        );
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $exp_date = Carbon::createFromFormat('d/m/Y', $request->input('exp_date'))->format('Y-m-d');
            $stock = Stocks::find($id);
            $stock->medicines_id = $request->input('medicine');
            $stock->quantity = $request->input('quantity');
            $stock->exp_date = $exp_date;
            $stock->save();
            return to_route(route: 'stocks.index')->with('message', 'Stock Updated Sucessfully!');
        }
    }

    public function disable(string $id)
    {
        $supplier = Stocks::find($id);
        $supplier->status = 0;
        $supplier->save();
        return to_route('stocks.index')->with('message', 'Stock Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $supplier = Stocks::find($id);
        $supplier->status = 1;
        $supplier->save();
        return to_route('stocks.index')->with('message', 'Stock enabled Sucessfully');
    }

    public function destroy(string $id)
    {
        $supplier=Stocks::find($id);
        $supplier->delete();
        return to_route('stocks.index')->with('message', 'Stock deleted Sucessfully');
    }
}
