<?php

namespace App\Http\Controllers;

use App\Models\TmArea;
use Illuminate\Http\Request;



class TmAreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$tblareas = TmArea::all();*/
        return view('areas');
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
        $areas = new TmArea;
        $areas-> descripcion=$request->input('desripcion-field');
        $areas-> idpersonal=$request->input('administrador-field');
        $areas-> idcuenta=$request->input('cuenta-field');
        $areas-> idccosto=$request->input('ccosto-field');
        $areas-> estado=$request->input('status-field');
        $areas-> usuario="";
        $areas->save();
        return redirect()->action([App\Http\Controllers\TmAreasController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
