<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Program;
use DB;
use Session;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return redirect('login');
        }
        else
        {
            $program=Program::all();
            return view('admin/masterprogram')->with('program', $program);
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
        $program = new Program();        
        $program->nama_program = $request->program;        
        $program->tahun = $request->year;
        $program->save();        
        return redirect()->route('masterprogram.index')
            ->with('alert-success', 'Data Berhasil Disimpan.');
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
        $program = Program::where('id_program',$id); 
        $program->update([
            'nama_program' => $request->program,
            'tahun' => $request->year
        ]);
        
        return redirect()->route('masterprogram.index')
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
        $program = Program::where('id_program',$id)->delete(); 
        
        return redirect()->route('masterprogram.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
