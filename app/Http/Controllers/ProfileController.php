<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
    	if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $id_user=Session::get('id_user');
            $user=DB::select(DB::raw("SELECT id_user, nama_user, email, password FROM users WHERE id_user=$id_user "));
            
    		return view('user/profile')->with('user', $user);
    	}
    }
    public function changepassword(Request $request)
    {
        $id_user=Session::get('id_user');
        $old_pass=DB::select(DB::raw("SELECT password FROM users where id_user=$id_user"));
        $req_pass=hash('md5',$request->old);
        
        // echo $old_pass[0] ; echo ','; echo $req_pass;
        if(strcasecmp($old_pass[0]->password,$req_pass)==0)
            {
                $new_pass=hash('md5',$request->new);
                $confirm_pass=hash('md5',$request->confirm);
                if(strcasecmp($new_pass,$confirm_pass)==0)
                    {
                        $user = User::where('id_user',$id_user); 
                        $user->update([
                            'password' => $confirm_pass
                        ]);
                        $id_user=Session::get('id_user');
                        $user=DB::select(DB::raw("SELECT id_user, nama_user, email, password FROM users WHERE id_user=$id_user "));
                        $message="Data berhasil diubah";
                        return view('user/profile',['Message' => $message])->with('user', $user);
                       
                        
                    }
                else 
                {
                    $id_user=Session::get('id_user');
                    $user=DB::select(DB::raw("SELECT id_user, nama_user, email, password FROM users WHERE id_user=$id_user "));
                    $message="New Password tidak sesuai dengan Confirm New Password";
                    return view('user/profile',['FailConfirmMessage' => $message])->with('user', $user);
                }
            }
        else {
             $id_user=Session::get('id_user');
             $user=DB::select(DB::raw("SELECT id_user, nama_user, email, password FROM users WHERE id_user=$id_user "));
             $message="Password yang lama tidak sesuai";
             return view('user/profile',['FailOldMessage' => $message])->with('user', $user);
        }
        // return view('user/profile');
    }
}
