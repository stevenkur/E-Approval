<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function __construct()
    {
    	// dd(Auth::user());
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('user/index');
    }
}
