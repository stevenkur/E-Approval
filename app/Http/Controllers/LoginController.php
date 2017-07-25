<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_role;
use App\Role;
use App\Users;
use DB;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {   
        if(!$request->session()->has('email'))
            return view('auth/login');
        else
            return redirect()->route('home');
    }
    
    public function login(Request $request)
    {
        $email = $request->email;
        $pwd = $request->password;
        
       

        $result=DB::select(DB::raw("SELECT A.id_user, C.email, B.nama_role FROM user_roles A, roles B, users C WHERE A.id_user=C.id_user and A.id_role=B.id_role "));
        
        
        if(isset($result)){
            dd($result);
            $id_user = $result->id_user;
            $email =   $result->email;
            $nama_role = $result->nama_role;

            $request->session()->put('id_user', $id_user);
            $request->session()->put('email', $email);
            $request->session()->put('nama_role', $nama_role);
            
            if(strcasecmp($nama_role, 'administrator')==0){	
            return redirect()->route('dashboard');
			}
			else{
            return redirect()->route('home');
        	}
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}