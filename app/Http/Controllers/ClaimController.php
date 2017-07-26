<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ClaimController extends Controller
{
    // public function __construct(Request $request)
    // {
    //     if(!$request->session()->has('email'))
    //         return view('auth/login');
    // }
    
    public function newclaim()
    {
        //
        if (!(Session::has('email')))
        {
            return view('auth/login'); 
        }
        else
        {
            return view('user/newclaim');
        }
    }

    public function listclaim()
    {
        //
        if (!(Session::has('email')))
        {
            return view('auth/login'); 
        }
        else
        {
            return view('user/listclaim');
        }
    }
}
