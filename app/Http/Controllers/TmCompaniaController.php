<?php

namespace App\Http\Controllers;

use App\Models\TmCompania;
use Illuminate\Http\Request;

class TmCompaniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresa');
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
     * @param  \App\Models\TmCompania  $tmCompania
     * @return \Illuminate\Http\Response
     */
    public function show(TmCompania $tmCompania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmCompania  $tmCompania
     * @return \Illuminate\Http\Response
     */
    public function edit(TmCompania $tmCompania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmCompania  $tmCompania
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmCompania $tmCompania)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmCompania  $tmCompania
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmCompania $tmCompania)
    {
        //
    }
}
