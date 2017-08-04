<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Marketing;
use App\Program;
use App\Distributor;
use App\Category;
use DB;
use Session;

class MarketingController extends Controller
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
            $marketing=DB::select(DB::raw("SELECT A.id_marketing, A.id_dist, B.nama_distributor, A.id_program, C.nama_program, A.entitlement,  A.maxclaim_date, D.nama_category, D.id_category FROM marketings A, distributors B, programs C, categories D WHERE A.id_dist=B.id_dist and A.id_program=C.id_program and A.id_category=D.id_category"));
            $program=Program::all();
            $distributor=Distributor::all();
            $category=Category::all();
            return view('admin/mastermarketing')->with('category', $category)->with('program', $program)->with('distributor', $distributor)->with('marketing', $marketing);
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
        $marketing = new Marketing();               
        $marketing->id_dist = $request->distributor; 
        $marketing->id_program = $request->program;    
        $marketing->id_category = $request->category;       
        $marketing->entitlement = $request->entitlement; 
        $marketing->maxclaim_date = $request->maxclaim;
        $marketing->save();        
        return redirect()->route('mastermarketing.index')
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
        $marketing = Marketing::where('id_marketing',$id); 
        $marketing->update([
            'id_dist' => $request->distributor,       
            'id_program' => $request->program,
            'id_category' => $request->category,
            'entitlement' => $request->entitlement,        
            'maxclaim_date' => $request->maxclaim 
            
         ]);
        
        return redirect()->route('mastermarketing.index')
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
        $marketing = Marketing::where('id_marketing',$id)->delete(); 
        
        return redirect()->route('mastermarketing.index')->with('alert-success', 'Data Berhasil Dihapus.');
   
    }
}
