<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Role;
use App\Flow;
use Session;
use DB;

class FlowController extends Controller
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
            return redirect('login');
        }
        else
        {
            $role=Role::all();
            $flow=DB::select(DB::raw("SELECT F.id_flow AS id_flow, F.kode_flow AS kode_flow, F.nama_flow AS nama_flow, F.level_flow AS level_flow, F.id_role, R.nama_role AS nama_role FROM flows F, roles R WHERE F.id_role=R.id_role "));            
            return view('admin/masterflow')->with('flow', $flow)->with('role', $role);
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
         // dd(Input::all());
        $flows=Input::all();
        // dd($flow['flow1']);
        $count = sizeof(Input::all())-3;

        // dd($count);
        for($i=1; $i<=$count; $i++)
        {        
        $flow= new Flow();
        $flow->id_role = $flows['flow'.$i];   
        $flow->kode_flow = $flows['flowcode'];
        $flow->nama_flow = $flows['flowname'];
        $flow->level_flow = $i;
        $flow->save();        
        
        }
        return redirect()->route('masterflow.index')
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
