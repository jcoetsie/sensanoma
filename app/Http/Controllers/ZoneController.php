<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Models\Area;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->account->areas->zones..
        $areas = Area::whereAccountId(Auth::id())->with(['account', 'zones'])->get();
        return view('zone.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAreas = Auth::user()->account->areas;
        $areas = [];
        foreach ($userAreas as $area)
            $areas[$area->id] = $area->name;

        return view('zone.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $area = Auth::user()->account->areas()->find($request->area_id);

        if(!$area)
            return redirect()->back()->withInput($request->toArray())->with('danger', 'An error occurred. Try again.');

        Zone::create([
            'name'          => $request->name,
            'crop'          => $request->crop,
            'coordinates'   => $request->coordinates,
            'area_id'       => $request->area_id
        ]);

        return redirect(route('zone.index'))->with('success', 'The zone has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        return view('zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        return view('zone.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        $zone->destroy($zone->id);

        return redirect(route('zone.index'))->with('success', 'The Zone has been deleted');
    }
}
