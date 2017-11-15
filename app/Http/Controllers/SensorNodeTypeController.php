<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorNodeTypeRequest;
use App\Models\SensorNodeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SensorNodeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensorNodeType = Auth::user()->account->sensorNodeTypes()->get()->toArray();
        return view('sensor_node_type.index', compact('sensorNodeType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sensorNodes = Auth::user()->account->sensorNodes()->get()->pluck('name', 'id');
        return view('sensor_node_type.create', compact('sensorNodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SensorNodeTypeRequest $request)
    {
        $sensorNode = Auth::user()->account->sensorNodes()->find($request->id);
        if(!$sensorNode)
            return redirect()->back()->withInput($request->toArray())->with('danger', 'An error occurred. Try again.');

        Auth::user()->account->sensorNodes->sensorNodeType()->create($request->toArray());

        return redirect(route(sensor_node_type.index))->with('success', 'The Sensor Node Type has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SensorNodeType  $sensorNodeType
     * @return \Illuminate\Http\Response
     */
    public function show(SensorNodeTypeRequest $sensorNodeType)
    {
        return view('sensor_node_type', compact('sensorNodeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SensorNodeType  $sensorNodeType
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorNodeType $sensorNodeType)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SensorNodeType  $sensorNodeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SensorNodeType $sensorNodeType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SensorNodeType  $sensorNodeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorNodeType $sensorNodeType)
    {
        //
    }
}
