<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DateTime;
use App\Holiday;
use DB;
use Session;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            $holiday=Holiday::all();
            return view('admin/masterholiday')->with('holiday',$holiday);
        }
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
        $holiday = new Holiday();     
        $string = $request->date;
        $date = DateTime::createFromFormat("Y-m-d", $string);            
        $holiday->date_name = $date->format("l");
        $holiday->tanggal_libur = $request->date; 
        $holiday->save();        
        return redirect()->route('masterholiday.index')
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
        $holiday = Holiday::where('id_holiday',$id); 
        $string = $request->date;
        $date = DateTime::createFromFormat("Y-m-d", $string);
        $holiday->update([
            'date_name' => $date->format("l"),
            'tanggal_libur' => $request->date
        ]);
        
        return redirect()->route('masterholiday.index')
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
        $holiday = Holiday::where('id_holiday',$id)->delete(); 
        
        return redirect()->route('masterholiday.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
