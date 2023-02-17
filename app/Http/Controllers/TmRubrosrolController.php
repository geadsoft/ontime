<?php

namespace App\Http\Controllers;

use App\Models\TmRubrosrol;
use Illuminate\Http\Request;

class TmRubrosrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rubros');
    }

    public function addrubros()
    {
        return view('rubros-add',['id' => 0]);
    }

    public function editrubros($rubroid)
    {
        return view('rubros-add',['id' => $rubroid]);
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
     * @param  \App\Models\TmRubrosrol  $tmRubrosrol
     * @return \Illuminate\Http\Response
     */
    public function show(TmRubrosrol $tmRubrosrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TmRubrosrol  $tmRubrosrol
     * @return \Illuminate\Http\Response
     */
    public function edit(TmRubrosrol $tmRubrosrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TmRubrosrol  $tmRubrosrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmRubrosrol $tmRubrosrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TmRubrosrol  $tmRubrosrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmRubrosrol $tmRubrosrol)
    {
        //
    }
}
