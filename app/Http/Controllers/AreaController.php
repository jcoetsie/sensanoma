<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\AreaRequest;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Auth::user()->account->areas;
        return view('area.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request, Area $area)
    {
        $this->authorize('create', $area);
        Auth::user()->account->areas()->create($request->toArray());
      
        return redirect(route('area.index'))->with('success', 'The Area has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        $area = Area::findOrFail($area->id);
        return view('area.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, Area $area)
    {
        $this->authorize('update', $area);
        $area->update($request->toArray());

        return redirect(route('area.show', $area))->with('success', 'The Area has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $this->authorize('delete', $area);
        $area->destroy($area->id);
      
        return redirect(route('area.index'))->with('success', 'The Area has been deleted');
    }
}
