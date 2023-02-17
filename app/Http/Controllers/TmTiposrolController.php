<?php

namespace App\Http\Controllers;

use App\Models\TmTiposrol;
use Illuminate\Http\Request;

class TmTiposrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tiposrol');
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
     * @param  \App\Models\TmTiposrol  $tmTiposrol
     * @return \Illuminate\Http\Response
     */
    public function show(TmTiposrol $tmTiposrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmTiposrol  $tmTiposrol
     * @return \Illuminate\Http\Response
     */
    public function edit(TmTiposrol $tmTiposrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmTiposrol  $tmTiposrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmTiposrol $tmTiposrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmTiposrol  $tmTiposrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmTiposrol $tmTiposrol)
    {
        //
    }
}
