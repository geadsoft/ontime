<?php

namespace App\Http\Controllers;

use App\Models\TmCatalogogeneral;
use Illuminate\Http\Request;

class TmCatalogogeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('catalogogen');
        return view('generalidad');
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
     * @param  \App\Models\TmCatalogogeneral  $tmCatalogogeneral
     * @return \Illuminate\Http\Response
     */
    public function show(TmCatalogogeneral $tmCatalogogeneral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmCatalogogeneral  $tmCatalogogeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(TmCatalogogeneral $tmCatalogogeneral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmCatalogogeneral  $tmCatalogogeneral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmCatalogogeneral $tmCatalogogeneral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmCatalogogeneral  $tmCatalogogeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmCatalogogeneral $tmCatalogogeneral)
    {
        //
    }
}
