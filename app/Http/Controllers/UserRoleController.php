<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_role;
use App\User;
use App\Role;
use DB;

class UserRole extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userrole=DB::select(DB::raw("SELECT A.id_user_roles, A.id_user, B.nama_user, A.id_role, C.nama_role FROM user_roles A, users B, roles C WHERE A.id_user=B.id_user and A.id_role=C.id_role"));
        $user=User::all();        
        $role=Role::all();

        return view('admin/masteruserrole')->with('useerrole', $userrole)->with('user', $user)->with('role', $role);

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
        $userrole = new User_role();
        $userrole->id_user = $request->user;
        $userrole->id_role = $request->role;
        $userrole->save();        
        return redirect()->route('masteruserrole.index')
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
        $userrole = User_role::where('id_user_roles',$id); 
        $userrole->update([
            'id_user' => $request->user,
            'id_role' => $request->role
        ]);
        
        return redirect()->route('masteruserrole.index')
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
         $userrole = User_role::where('id_user_roles',$id)->delete(); 
        
        return redirect()->route('masteruserrole.index')->with('alert-success', 'Data Berhasil Dihapus.');
  
    }
}
