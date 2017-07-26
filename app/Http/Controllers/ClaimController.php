<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user/newclaim');
    }

    public function listclaim()
    {
        //
        return view('user/listclaim');
    }
}
