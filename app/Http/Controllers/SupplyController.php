<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\HeadQuarters;
use App\Models\Medicines;
use App\Models\SupplyHead;
use App\Models\SupplyItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supply = SupplyHead::select('supply_heads.*', 'clients.company_name as client')
            ->orderBy('id', 'DESC')
            ->join('clients', 'clients.id', "=", 'supply_heads.client_id')->get();
        return view('Supply.list', ['supplies' => $supply]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('company_name', 'ASC')->get();
        $headQuarters = HeadQuarters::orderBy('name', 'ASC')->get();
        $medicines = Medicines::all();
        return view('Supply.create', ['clients' => $clients, 'hqs' => $headQuarters, 'medicines' => $medicines]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sgst = 2.5;
        $cgst = 2.5;
        $medicinesId = $request->input('medicine');
        $quantities = $request->input('quantity');
        $subtotal = 0;
        for ($i = 0; $i < count($quantities); $i++) {
            $medicine = Medicines::find($medicinesId[$i]);
            $amount = $medicine->amount * $quantities[$i];
            $subtotal += $amount;
        }
        $discountType = $request->input(key: 'discount_type');
        $discount = 0;
        if ($discountType == "amount") {
            $discount = $request->input(key: 'discount');
        } else {
            $discount = $subtotal * $request->input(key: 'discount') / 100;
        }
        $discountedAmount = $subtotal - $discount;
        $supplyHead = new SupplyHead();
        $supplyHead->sub_total = $subtotal;
        $supplyHead->discount = $discount;

        $supplyHead->client_id = $request->input('client');
        $supply_date = Carbon::createFromFormat('d/m/Y', $request->input('supply_date'))->format('Y-m-d');
        $supplyHead->supply_date = $supply_date;
        $due_date = Carbon::createFromFormat('d/m/Y', $request->input('due_date'))->format('Y-m-d');
        $supplyHead->due_date = $due_date;
        $supplyHead->sgst = $discountedAmount * $sgst / 100;
        $supplyHead->cgst = $discountedAmount * $cgst / 100;
        $totalTax = $discountedAmount * 5 / 100;
        $finalAmount = $discountedAmount + $totalTax;
        $supplyHead->total = $finalAmount;
        $supplyHead->payment_mode = $request->input('payment_mode');
        if ($request->input('payment_mode') == "Credit") {
            $supplyHead->payment_status = 0;
        } else {
            $supplyHead->payment_status = 1;
        }
        $supplyHead->save();
        for ($i = 0; $i < count($quantities); $i++) {
            $supplyItem = new SupplyItem();
            $medicine = Medicines::find($medicinesId[$i]);
            $amount = $medicine->amount;
            $supplyItem->medicines_id = $medicinesId[$i];
            $supplyItem->quantity = $quantities[$i];
            $itemSubTotal = $amount * $quantities[$i];
            $itemSgst = $itemSubTotal * $sgst / 100;
            $itemCgst = $itemSubTotal * $cgst / 100;
            $supplyItem->sgst = $itemSgst;
            $supplyItem->cgst = $itemCgst;
            $itemTotalTax = $itemSgst + $itemCgst;
            $itemTotal = $itemTotalTax + $itemSubTotal;
            $supplyItem->item_total = $itemTotal;
            $supplyItem->supply_head_id = $supplyHead->id;
            $supplyItem->save();
        }
        return to_route('supplies.index')->with('message', 'Supply Added Sucessfully!');
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
        $clients = Client::orderBy('company_name', 'ASC')->get();
        $headQuarters = HeadQuarters::orderBy('name', 'ASC')->get();
        $medicines = Medicines::all();
        $supplyHead = SupplyHead::find($id);
        $supplyItems = SupplyItem::select('supply_items.*', 'medicines.amount')
            ->where('supply_head_id', "=", $supplyHead->id)
            ->join('medicines', "medicines.id", "=", "supply_items.medicines_id")
            ->get();

        return view('Supply.edit', ['clients' => $clients, 'hqs' => $headQuarters, 'medicines' => $medicines, 'supplyHead' => $supplyHead, 'supplyItems' => $supplyItems]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sgst = 2.5;
        $cgst = 2.5;
        $medicinesId = $request->input('medicine');
        $quantities = $request->input('quantity');
        $subtotal = 0;
        for ($i = 0; $i < count($quantities); $i++) {
            $medicine = Medicines::find($medicinesId[$i]);
            $amount = $medicine->amount * $quantities[$i];
            $subtotal += $amount;
        }
        $discountType = $request->input(key: 'discount_type');
        $discount = 0;
        if ($discountType == "amount") {
            $discount = $request->input(key: 'discount');
        } else {
            $discount = $subtotal * $request->input(key: 'discount') / 100;
        }
        $discountedAmount = $subtotal - $discount;
        $supplyHead = SupplyHead::find($id);
        $supplyHead->sub_total = $subtotal;
        $supplyHead->discount = $discount;

        $supplyHead->client_id = $request->input('client');
        $supply_date = Carbon::createFromFormat('d/m/Y', $request->input('supply_date'))->format('Y-m-d');
        $supplyHead->supply_date = $supply_date;
        $due_date = Carbon::createFromFormat('d/m/Y', $request->input('due_date'))->format('Y-m-d');
        $supplyHead->due_date = $due_date;
        $supplyHead->sgst = $discountedAmount * $sgst / 100;
        $supplyHead->cgst = $discountedAmount * $cgst / 100;
        $totalTax = $discountedAmount * 5 / 100;
        $finalAmount = $discountedAmount + $totalTax;
        $supplyHead->total = $finalAmount;
        $supplyHead->payment_mode = $request->input('payment_mode');
        if ($request->input('payment_mode') == "Credit") {
            $supplyHead->payment_status = 0;
        } else {
            $supplyHead->payment_status = 1;
        }
        $supplyHead->save();

        $supplyItems = SupplyItem::select()
            ->where('supply_head_id', "=", $supplyHead->id)
            ->get();
        foreach ($supplyItems as $supplyItem) {
            $supplyItem->delete();
        }
        for ($i = 0; $i < count($quantities); $i++) {
            $supplyItem = new SupplyItem();
            $medicine = Medicines::find($medicinesId[$i]);
            $amount = $medicine->amount;
            $supplyItem->medicines_id = $medicinesId[$i];
            $supplyItem->quantity = $quantities[$i];
            $itemSubTotal = $amount * $quantities[$i];
            $itemSgst = $itemSubTotal * $sgst / 100;
            $itemCgst = $itemSubTotal * $cgst / 100;
            $supplyItem->sgst = $itemSgst;
            $supplyItem->cgst = $itemCgst;
            $itemTotalTax = $itemSgst + $itemCgst;
            $itemTotal = $itemTotalTax + $itemSubTotal;
            $supplyItem->item_total = $itemTotal;
            $supplyItem->supply_head_id = $supplyHead->id;
            $supplyItem->save();
        }
        return to_route('supplies.index')->with('message', 'Supply Update Sucessfully!');
    }
    public function unpaid(string $id)
    {
        $supplyHead = SupplyHead::find($id);
        $supplyHead->payment_status = 0;
        $supplyHead->save();
        return to_route('supplies.index')->with('message', 'Supply Marked as Not Paid!');
    }
    public function paid(string $id)
    {
        $supplyHead = SupplyHead::find($id);
        $supplyHead->payment_status = 1;
        $supplyHead->save();
        return to_route('supplies.index')->with('message', 'Supply Marked as Paid!');
    }
    public function destroy(string $id)
    {
        //
    }
}
