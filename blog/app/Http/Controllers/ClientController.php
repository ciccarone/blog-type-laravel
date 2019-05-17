<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    function __construct()
    {
      $this->clients = Client::all();
      $this->keyed_names['clients'] = SELF::keyed_names($this->clients, 'client_name');
    }

    /**
     * Return an array of keyed database entries
     *
     * @return \Illuminate\Http\Array
     */
    private function keyed_names($collection, String $name_column)
    {
      $ret = false;

      foreach ($collection as $key => $value) {
        $ret[$value->id] = $value->$name_column;
      }

      return $ret;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clients = $this->clients;
      $keyed_clients = $this->keyed_names['clients'];
      return view('clients.admin', compact('clients', 'keyed_clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clients = Client::all();
      return view('clients.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'client_name'=>'required',
        'client_description'=> 'required',
      ]);
      $service = new Client([
        'client_name' => $request->get('client_name'),
        'client_description'=> $request->get('client_description'),
        'client_logo'=> $request->get('client_logo')
      ]);
      $service->save();
      return redirect('/admin/clients')->with('success', 'Client has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $client = Client::find($id);
      $clients = Client::all();
      return view('clients.edit', compact('client', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'client_name'=>'required',
        'client_description'=> 'required',
      ]);

      $client = Client::find($id);
      $client->client_name = $request->get('client_name');
      $client->client_description = $request->get('client_description');
      $client->client_logo = $request->get('client_logo');
      $client->save();

      return redirect('admin/clients/' . $id . '/edit')->with('success', 'Client has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
