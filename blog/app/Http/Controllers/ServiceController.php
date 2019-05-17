<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{

    function __construct()
    {
      $this->services = Service::all();
      $this->keyed_names['services'] = SELF::keyed_names($this->services, 'service_name');
    }

    /**
     * Return an array of keyed database entries
     *
     * @return \Illuminate\Http\Array
     */
    private function keyed_names($collection, String $name_column)
    {
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
      $services = $this->services;
      $keyed_services = $this->keyed_names['services'];
      return view('services.admin', compact('services', 'keyed_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $services = Service::all();
      return view('services.create', compact('services'));
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
        'service_name'=>'required',
        'service_description'=> 'required',
      ]);
      $service = new Service([
        'service_name' => $request->get('service_name'),
        'service_description'=> $request->get('service_description'),
        'service_parent'=> $request->get('service_parent')
      ]);
      $service->save();
      return redirect('/admin/services')->with('success', 'Service has been added');
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
      $service = Service::find($id);
      $services = Service::all();
      return view('services.edit', compact('service', 'services'));
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
        'service_name'=>'required',
        'service_description'=> 'required',
      ]);

      $service = Service::find($id);
      $service->service_name = $request->get('service_name');
      $service->service_description = $request->get('service_description');
      $service->service_parent = $request->get('service_parent');
      $service->save();

      return redirect('admin/services/' . $id . '/edit')->with('success', 'Service has been added');
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
