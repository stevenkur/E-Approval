<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distributor;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $distributor=Distributor::all();
        return view('admin/masterdistributor')->with('distributor', $distributor);
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
        $distributor = new Distributor();
        $distributor->distributor_id = $request->distributorid;
        $distributor->nama_distributor = $request->distributorname;
        $distributor->country = $request->country;
        $distributor->save();        
        return redirect()->route('masterdistributor.index')
            ->with('alert-success', 'Data Berhasil Disimpan.');
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
        $distributor = Distributor::where('id_dist',$id); 
        $distributor->update([
            'distributor_id' => $request->distributorid,
            'nama_distributor' => $request->distributorname,
            'country' => $request->country
        ]);
        
        return redirect()->route('masterdistributor.index')
            ->with('alert-success', 'Data Berhasil Diupdate.');
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
        $distributor = Distributor::where('id_dist',$id)->delete(); 
        
        return redirect()->route('masterdistributor.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
