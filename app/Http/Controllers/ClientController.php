<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::query()->get();
        return view('Client.list', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $rule = array(
            'company_name' => 'required',
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
            // echo"failed"; exit;
            return Redirect::back()->withErrors($validator->errors())->withInput();
        } else {
            $client = new Client();
            $client->company_name = $request->input('company_name');
            $client->email = $request->input('email');
            $client->mobile = $request->input('mobile');
            $client->contact_person = $request->input('contact_name');
            $client->contact_mobile = $request->input('contact_mobile');
            $client->adr_ln1 = $request->input('adrl1');
            $client->adr_ln2 = $request->input('adrl2');
            $client->city = $request->input('city');
            $client->pincode = $request->input('pincode');
            $client->state = $request->input('state');
            $client->save();
            return to_route('clients.index')->with('message', 'Client Added Sucessfully!');
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
        $client =Client::find($id);
        return view('Client.edit',['client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->input();
        $rule = array(
            'company_name' => 'required',
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
            $client =Client::find($id);
            $client->company_name = $request->input('company_name');
            $client->email = $request->input('email');
            $client->mobile = $request->input('mobile');
            $client->contact_person = $request->input('contact_name');
            $client->contact_mobile = $request->input('contact_mobile');
            $client->adr_ln1 = $request->input('adrl1');
            $client->adr_ln2 = $request->input('adrl2');
            $client->city = $request->input('city');
            $client->pincode = $request->input('pincode');
            $client->state = $request->input('state');
            $client->save();
            return to_route('clients.index')->with('message', 'Client Updated Sucessfully!');
        }
    }

    public function disable(string $id)
    {
        $client = Client::find($id);
        $client->status = 0;
        $client->save();
        return to_route('clients.index')->with('message', 'Client Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $client = Client::find($id);
        $client->status = 1;
        $client->save();
        return to_route('clients.index')->with('message', 'Client enabled Sucessfully');
    }

    public function destroy(string $id)
    {
        $client=Client::find($id);
        $client->delete();
        return to_route('clients.index')->with('message', 'Client deleted Sucessfully');
    }
}
