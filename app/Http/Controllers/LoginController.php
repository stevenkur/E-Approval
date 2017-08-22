<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Users;
use DB;
use Session;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {   
        if(!$request->session()->has('email'))
            return view('auth/login');
        else
            if(Session::get('nama_user')=='Administrator')
                return redirect()->route('dashboard');
            else
                return redirect()->route('home.index');
    }
    
    public function login(Request $request)
    {
        $email = $request->email;
        $pwd = hash('md5', $request->password);              


        $result=DB::select(DB::raw("SELECT A.id_user, C.nama_user, C.email, B.nama_role, D.nama_category FROM category_accesses A, roles B, users C, categories D WHERE C.email='$email' and C.password='$pwd' and A.id_user=C.id_user and A.id_role=B.id_role and A.id_category=D.id_category"));
        // dd($result);
        if(isset($result[0])){
            
            $id_user = $result[0]->id_user;
            $nama_user = $result[0]->nama_user;
            $email =   $result[0]->email;
            $role = array();
            $nama_category = array();
            if(strcasecmp($result[0]->nama_role, 'Administrator')==0){
                $request->session()->put('id_user', $id_user);
                $request->session()->put('nama_user', $nama_user);
                $request->session()->put('email', $email);
                return redirect()->route('dashboard');
			}
			else{                
                $request->session()->put('id_user', $id_user);
                $request->session()->put('nama_user', $nama_user);
                $request->session()->put('email', $email);
                for($i=0;$i<sizeof($result);$i++)
                {
                    $role[] = $result[$i]->nama_role;
                    $nama_category[] = $result[$i]->nama_category;
                }
                $request->session()->put('role', $role);
                $request->session()->put('nama_category', $nama_category);
                $category = Session::get('nama_category');
                $request->session()->put('categories', $category[0]);
                $category_now = Session::get('categories');
                // dd(Session()->all());
                return redirect()->route('home.index');
        	}
        }
        else{
            return redirect()->route('login');
        }
    }

    public function index2(Request $request)
    {   
        if(!$request->session()->has('email'))
            return view('auth/login2');
        else
            if(Session::get('nama_user')=='Administrator')
                return redirect()->route('dashboard');
            else
                return redirect()->route('home.index');
    }
    
    public function login2(Request $request)
    {
        $email = $request->email;
        $pwd = hash('md5', $request->password);              


        $result=DB::select(DB::raw("SELECT A.id_user, C.nama_user, C.email, B.nama_role, D.nama_category FROM category_accesses A, roles B, users C, categories D WHERE C.email='$email' and C.password='$pwd' and A.id_user=C.id_user and A.id_role=B.id_role and A.id_category=D.id_category"));
        // dd($result);
        if(isset($result[0])){
            
            $id_user = $result[0]->id_user;
            $nama_user = $result[0]->nama_user;
            $email =   $result[0]->email;
            $role = array();
            $nama_category = array();
            if(strcasecmp($result[0]->nama_role, 'Administrator')==0){
                $request->session()->put('id_user', $id_user);
                $request->session()->put('nama_user', $nama_user);
                $request->session()->put('email', $email);
                return redirect()->route('dashboard');
            }
            else{                
                $request->session()->put('id_user', $id_user);
                $request->session()->put('nama_user', $nama_user);
                $request->session()->put('email', $email);
                for($i=0;$i<sizeof($result);$i++)
                {
                    $role[] = $result[$i]->nama_role;
                    $nama_category[] = $result[$i]->nama_category;
                }
                $request->session()->put('role', $role);
                $request->session()->put('nama_category', $nama_category);
                $category = Session::get('nama_category');
                $request->session()->put('categories', $category[0]);
                $category_now = Session::get('categories');
                // dd(Session()->all());
                return redirect()->route('listclaim');
            }
        }
        else{
            return redirect()->route('login2');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}