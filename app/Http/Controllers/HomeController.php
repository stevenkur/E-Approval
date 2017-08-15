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
                $query[$i]= DB::select(DB::raw("SELECT A.nama_category,CONCAT('Rp ',FORMAT(sum(A.value),0,'de_DE'))  as value,B.id_role,B.nama_role FROM claims A, roles B, flows C, user_distributors D, distributors E where A.kode_flow = C.kode_flow and A.level_flow=C.level_flow and D.id_user=$user and D.id_dist=E.id_dist and E.nama_distributor=A.nama_distributor and B.id_role=C.id_role and A.nama_category ='$nama_category' GROUP BY A.nama_category, B.nama_role, B.id_role ORDER BY B.id_role"));
                $lengths=sizeof($query[$i]);
                


            }
            $pisah = array();
            // dd($query);
            for($i=0;$i<$length;$i++)
            {

                $query_length= sizeof($query[$i]);
                
                for($j=0;$j<$query_length;$j++)
                {
                    $nama_role[] = $query[$i][$j]->nama_role; 
                }
                
                if($query_length!=0)
                {
                // dd($claim);
                
                foreach($query[$i] as $key=>$value){
                        $id = $value->nama_role;
                        // dd($id);
                        // dd($value);
                        if(!isset($pisah[$id])) 
                        {
                            $pisah[$i][$id] = array();
                            $j=0;

                        }
                        $j++;
                        $pisah[$i][$id][$j] = $value;
                        // dd($pisah[$id]);
                    }
                }
            // dd($length);
            // dd($claim[1]);
            // dd(isset($claim[$z]));
                
            }
            
            $role = array_unique($nama_role);
            
            // dd($query);
            // $role=array_unique(array_merge($query[0],$query[1],$query[2],$query[3]), SORT_REGULAR);
            // dd($role);
            
            // return view('user/index')->with('category', $category)->with('role',$role);
            
            return view('user/index')->with('query',$query)->with('category', $category)->with('role', $role)->with('pisah',$pisah);
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
