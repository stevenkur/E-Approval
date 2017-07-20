<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\CategoryDetail;
use App\Category;
use DB;

class CategoryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorydetail=CategoryDetail::all();
        $category=Category::all();
        return view('admin/mastercategorydetail')->with('categorydetail', $categorydetail)->with('category',$category);

       
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
        $categorydetail = new CategoryDetail();        
        $categorydetail->nama_category = $request->category;        
        $categorydetail->category_type = $request->categorytype; 
        $categorydetail->save();        
        return redirect()->route('mastercategorydetail.index')
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
        $categorydetail = CategoryDetail::where('id_categorydetail',$id); 
        $categorydetail->update([
            'nama_category' => $request->category,
            'category_type' => $request->categorytype
         ]);
        
        return redirect()->route('mastercategorydetail.index')
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
         $categorydetail = CategoryDetail::where('id_categorydetail',$id)->delete(); 
        
        return redirect()->route('mastercategorydetail.index')->with('alert-success', 'Data Berhasil Dihapus.');
   
    }
}
