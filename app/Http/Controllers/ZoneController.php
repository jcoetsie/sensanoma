<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Auth::user()->account->areas->zone;
        return view('zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zones
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zones
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zones)
    {
        //
    }
}
