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
            $length=sizeof($category);
            
            for($i=0;$i<$length;$i++)
            {
                $nama_category = $category[$i]->nama_category;
                $query[$i]= DB::select(DB::raw("SELECT A.nama_category,sum(A.value) as value,B.id_role,B.nama_role FROM claims A, roles B, flows C where A.kode_flow = C.kode_flow and A.level_flow=C.level_flow and A.id_user=$user and B.id_role=C.id_role and A.nama_category ='$nama_category' GROUP BY A.nama_category, B.nama_role, B.id_role "));
            }

            for($i=0;$i<$length;$i++)
            {

                $query_length= sizeof($query[$i]);
                for($j=0;$j<$query_length;$j++)
                {
                    $nama_role[] = $query[$i][$j]->nama_role; 
                }

            }
            $role = array_unique($nama_role);
//            dd($role);
            // dd($query);
            // $role=array_unique(array_merge($query[0],$query[1],$query[2],$query[3]), SORT_REGULAR);
            // dd($role);
            
            // return view('user/index')->with('category', $category)->with('role',$role);
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
            return redirect()->back();
            
        }
    }
}
