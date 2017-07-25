<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function query()
    {
        return view('admin/query');
    }

    public function queryresult()
    {        
        // dd(Input::all());
        $input=Input::all();
        $query=$input['query'];
        $result=DB::select(DB::raw($query));
        $raw=explode(" ", $query);
        if(strcasecmp($raw[0], 'select')==0)
        {
            // dd($result);
            return view('admin/query')->with('result', $result);

        }
        else if(strcasecmp($raw[0], 'insert')==0)
        {
            $message="Data berhasil ditambah";
            return view('admin/query', ['Message' => $message]);
        }
        else if(strcasecmp($raw[0], 'update')==0)
        {
            $message="Data berhasil diubah";
            return view('admin/query', ['Message' => $message]);
        }
        else if(strcasecmp($raw[0], 'delete')==0)
        {
            $message="Data berhasil dihapus";
            return view('admin/query', ['Message' => $message]);
        }
        else
        {
            $message="Perintah tidak diketahui";
            return view('admin/query', ['Message' => $message]);
        }
    }

    public function listticket()
    {
        return view('admin/listticket');
    }

    public function listattachment()
    {
        return view('admin/listattachment');
    }

    public function listperiod()
    {
        return view('admin/listperiod');
    }
}
