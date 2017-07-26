<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function changepassword()
    {
    	if (!(Session::has('email')))
        {
            return view('auth/login'); 
        }
        else
        {
    		return view('user/profile');
    	}
    }
}
