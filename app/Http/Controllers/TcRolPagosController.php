<?php

namespace App\Http\Controllers;

use App\Models\TcRolPagos;
use Illuminate\Http\Request;

class TcRolPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nominas');
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
     * @param  \App\Models\TcRolPago  $tcRolPago
     * @return \Illuminate\Http\Response
     */
    public function show(TcRolPago $tcRolPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TcRolPago  $tcRolPago
     * @return \Illuminate\Http\Response
     */
    public function edit(TcRolPago $tcRolPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TcRolPago  $tcRolPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TcRolPago $tcRolPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TcRolPago  $tcRolPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(TcRolPago $tcRolPago)
    {
        //
    }
}
