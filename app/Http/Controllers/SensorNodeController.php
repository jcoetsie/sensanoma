<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorNodeRequest;
use App\Models\SensorNode;
use Illuminate\Support\Facades\Auth;

class SensorNodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensorNodes = Auth::user()->account->sensorNodes()->get();

        return view('sensor_node.index', compact('sensorNodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userZones = Auth::user()->account->zones()->get();

        if(!$userZones->toArray())
            return redirect(route('sensor_node.index'))->with('danger', 'You need to create a zone first.');

        $zones = [];
        foreach ($userZones as $uzone)
            $zones[$uzone->id] = $uzone->name;

        return view('sensor_node.create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SensorNodeRequest $request)
    {
        $zone = Auth::user()->account->zones()->find($request->zone_id);
        if(!$zone)
            return redirect()->back()->withInput($request->toArray())->with('danger', 'An error occurred. Try again.');

        Auth::user()->account->sensorNodes()->create($request->toArray());
        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function show(SensorNode $sensorNode)
    {
        return view('sensor_node.show', compact('sensorNode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorNode $sensorNode)
    {
        $userZones = Auth::user()->account->zones()->get();

        $zones = [];
        foreach ($userZones as $uzone)
            $zones[$uzone->id] = $uzone->name;

        return view('sensor_node.edit', compact('sensorNode', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function update(SensorNodeRequest $request, SensorNode $sensorNode)
    {
        $zone = Auth::user()->account->zones()->find($request->zone_id);
        if(!$zone)
            return redirect()->back()->withInput($request->toArray())->with('danger', 'An error occurred. Try again.');

        $sensorNode->update($request->toArray());
        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorNode $sensorNode)
    {
        $sensorNode->destroy($sensorNode->id);

        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been deleted');
    }
}
