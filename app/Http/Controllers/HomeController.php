<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Category;
use App\Category_access;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     dd(Auth::user());
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $user = Session::get('id_user');
            $category=DB::select(DB::raw("SELECT A.id_access, A.id_category, A.id_role, B.nama_category FROM category_accesses A, categories B WHERE A.id_category=B.id_category and A.id_user=$user "));
            return view('user/index')->with('category', $category);
        }
    }

    public function changearea($category)
    {
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            // var_dump($category);
            session()->put('categories', $category);
            return redirect()->route('home.index');
            
        }
    }
}
