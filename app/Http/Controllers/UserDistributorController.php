<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_distributor;
use App\User;
use App\Distributor;
use DB;

class UserDistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userdistributor=DB::select(DB::raw("SELECT A.id_user_distributor, A.id_user, B.nama_user, A.id_dist, C.nama_distributor FROM user_distributors A, users B, distributors C WHERE A.id_user=B.id_user and A.id_dist=C.id_dist"));
        $user=User::all();        
        $distributor=Distributor::all();

        return view('admin/masteruserdistributor')->with('userdistributor', $userdistributor)->with('user', $user)->with('distributor', $distributor);
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
        $userdistributor = new User_distributor();
        $userdistributor->id_user = $request->user;
        $userdistributor->id_dist = $request->distributor;
        $userdistributor->save();        
        return redirect()->route('masteruserdistributor.index')
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
        $userdistributor = User_distributor::where('id_user_distributor',$id); 
        $userdistributor->update([
            'id_user' => $request->user,
            'id_dist' => $request->distributor
        ]);
        
        return redirect()->route('masteruserdistributor.index')
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
        $userdistributor = User_distributor::where('id_user_distributor',$id)->delete(); 
        
        return redirect()->route('masteruserdistributor.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
