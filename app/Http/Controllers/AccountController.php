<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Role;
use App\Distributor;
use App\Category_access;
use DB;
use Session;

class AccountController extends Controller
{
    // public function __construct(Request $request)
    // {
    //     if(!$request->session()->has('email'))
    //         return view('auth/login');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return redirect('login');
        }
        else
        {
            $user=DB::select(DB::raw("SELECT A.id_user,A.email, A.nama_user,A.password, GROUP_CONCAT(DISTINCT C.nama_category SEPARATOR ', ') as category, GROUP_CONCAT(DISTINCT D.nama_role SEPARATOR ' ') as role, GROUP_CONCAT(DISTINCT E.distributor_id SEPARATOR ', ') as distributor, GROUP_CONCAT(DISTINCT B.id_category SEPARATOR ' ') as id_category, GROUP_CONCAT(DISTINCT B.id_role SEPARATOR ', ') as id_role, GROUP_CONCAT(DISTINCT F.id_dist SEPARATOR ' ') as id_dist FROM users A, category_accesses B, categories C, roles D, distributors E, user_distributors F WHERE (B.id_user=A.id_user and B.id_category=C.id_category and B.id_role=D.id_role and F.id_dist=E.id_dist and A.id_user=F.id_user) group by A.id_user, A.email, A.nama_user, A.password" ));
            $count=User::all();
            $category=Category::all();
            $role=Role::all();
            return view('admin/masteraccount')->with('user', $user)->with('count', $count)->with('role', $role)->with('category',$category);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input=Input::all();
        // dd($input);
        
        $user = new User;
        $user->email = $input['email'];
        $user->nama_user = $input['name'];
        $user->password = hash('md5', $input['password']);
        for($i=2;$i<=9;$i++)
        {
            $var = 'email'.$i;
            if($request->has($var))
            {
                $user->$var = $input[$var];
            }
        }
        $user->save();

        $find = User::where('email', '=' , $input['email'])->first();

        $category=count(Category::all());
        for($i=1;$i<=$category;$i++)
        {
            if($input['checklist'.$i]!=0)
            {                
                $access = new Category_access;
                $access->id_user = $find->id_user;
                $access->id_category = $input['checklist'.$i];
                $access->id_role = $input['role'.$i];
                $access->auto_approved = $input['autoapproved'.$i];
                $access->save();
            }
        }

        return redirect()->route('masteraccount.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::where('id_user',$id); 
        $user->update([
            'email' => $request->email,
            'nama_user' => $request->nama_user,
            'password' => $request->password
        ]);
        
        return redirect()->route('masteraccount.index')
            ->with('alert-success', 'Data Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::where('id_user', $id)->delete();
        $access = Category_access::where('id_user', $id)->delete(); 
        
        return redirect()->route('masteraccount.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
