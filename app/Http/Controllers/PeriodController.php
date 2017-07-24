<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Period;
use DB;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $period=Period::all();
        return view('admin/masterperiod')->with('period', $period);
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
        $period = new Period();        
        $period->tahun = $request->tahun;        
        $period->kuarter = $request->kuarter;
        $period->bulan = $request->bulan;        
        $period->minggu = $request->minggu;
        $period->start_date = $request->startdate;        
        $period->end_date = $request->enddate;
        $period->save();        
        return redirect()->route('masterperiod.index')
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
        $period = Period::where('id_period',$id); 
        $period->update([
            'tahun' => $request->tahun,        
            'kuarter' => $request->kuarter,
            'bulan' => $request->bulan,        
            'minggu' => $request->minggu,
            'start_date' => $request->startdate,        
            'end_date' => $request->enddate
           
        ]);
        
        return redirect()->route('masterperiod.index')
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
        $period = Period::where('id_period',$id)->delete(); 
        
        return redirect()->route('masterperiod.index')->with('alert-success', 'Data Berhasil Dihapus.');
  
    }
}
