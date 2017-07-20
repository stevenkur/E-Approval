<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Category_access;
use App\Role;
use App\Category;
use App\User;
use DB;

class CategoryAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryaccess=DB::select(DB::raw("SELECT A.id_access, A.id_user, B.nama_user, A.id_role, C.nama_role, A.id_category, D.nama_category, A.auto_approved FROM category_accesses A, users B, roles C, categories D WHERE A.id_user=B.id_user and A.id_role=C.id_role and A.id_category=D.id_category"));
        $category=Category::all();
        $role=Role::all();
        $user=User::all();
        return view('admin/mastercategoryaccess')->with('user', $user)->with('role', $role)->with('categoryaccess', $categoryaccess)->with('category',$category);

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
        $categoryaccess = new Category_access();        
        $categoryaccess->id_user = $request->user;        
        $categoryaccess->id_category = $request->category; 
        $categoryaccess->id_role = $request->role;        
        $categoryaccess->auto_approved = $request->approveday; 
        $categoryaccess->save();        
        return redirect()->route('mastercategoryaccess.index')
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
         $categoryaccess = Category_access::where('id_access',$id); 
         $categoryaccess->update([
            'id_user' => $request->user,       
            'id_category' => $request->category,
            'id_role' => $request->role,        
            'auto_approved' => $request->approveday 
            
         ]);
        
        return redirect()->route('mastercategoryaccess.index')
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
         $categoryaccess = Category_access::where('id_access',$id)->delete(); 
        
        return redirect()->route('mastercategoryaccess.index')->with('alert-success', 'Data Berhasil Dihapus.');
   
    }
}
