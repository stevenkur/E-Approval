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
        // dd($flows);
        $count = sizeof(Input::all())-4;
        // dd($flows);
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
        // //
        // // dd($id);
        $flows=Input::all();
        // dd($flows);
        $jumlah = (sizeof($flows)-4)/2;
        // dd($jumlah);
        $key = array_keys((array)$flows); 
        // dd($key);
        $idflow = [];
        for($i=(sizeof($flows)-$jumlah);$i<=sizeof($flows)-1;$i++)
        {
            $idflow[] = $key[$i];
        }
        // dd($idflow);
        // $count = sizeof(Input::all())-4;
        // dd($request->flowcode);
        // dd($jumlah);
        dd($flows);
        // dd($count);
        // dd($flows);
        for($i=0; $i<$jumlah; $i++)
        {        
        $nama= 'flow'.$i;
        // dd($flow);
        $flow = Flow::where('id_flow',$idflow[$i] ); 
        $flow->update([
            'kode_flow' => $request->flowcode,
            'nama_flow' => $request->flowname,
            'id_role' => $request->$nama,
            'level_flow' => $i+1
        ]);
          
            
        
        }
        return redirect()->route('masterflow.index')
            ->with('alert-success', 'Data Berhasil Disimpan.');
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
