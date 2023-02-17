<?php

namespace App\Http\Controllers;

use App\Models\TmPeriodosrol;
use Illuminate\Http\Request;

class TmPeriodosrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('periodos');
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
     * @param  \App\Models\TmPeriodosrol  $tmPeriodosrol
     * @return \Illuminate\Http\Response
     */
    public function show(TmPeriodosrol $tmPeriodosrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmPeriodosrol  $tmPeriodosrol
     * @return \Illuminate\Http\Response
     */
    public function edit(TmPeriodosrol $tmPeriodosrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmPeriodosrol  $tmPeriodosrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmPeriodosrol $tmPeriodosrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmPeriodosrol  $tmPeriodosrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmPeriodosrol $tmPeriodosrol)
    {
        //
    }
}
