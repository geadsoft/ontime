<?php

namespace App\Http\Controllers;

use App\Models\TmCargocia;
use Illuminate\Http\Request;

class TmCargociaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cargocia');
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
     * @param  \App\Models\TmCargocia  $tmCargocia
     * @return \Illuminate\Http\Response
     */
    public function show(TmCargocia $tmCargocia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmCargocia  $tmCargocia
     * @return \Illuminate\Http\Response
     */
    public function edit(TmCargocia $tmCargocia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmCargocia  $tmCargocia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmCargocia $tmCargocia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmCargocia  $tmCargocia
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmCargocia $tmCargocia)
    {
        //
    }
}
