<?php

namespace App\Http\Controllers;

use App\kela;
use App\matapelajaran;
use App\siswa;
use Illuminate\Http\Request;

class crudNilaiSiswa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jml_sembunyi = siswa::where('status', '0')->get();
        $mapels = matapelajaran::all();
        $siswas = siswa::all();
        $kelass = kela::all();
        return view('detailNilai')->with([
            'siswas' => $siswas,
            'kelass' => $kelass,
            'jml_sembunyi' => $jml_sembunyi,
            'mapels' => $mapels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mapels = matapelajaran::all();
        $find = $id;
        $jml_sembunyi = siswa::where('status', '0')->get();
        if($find === "tersembunyi"){
            $kelass = kela::all();
            $siswas = siswa::all();
            return view('detailnilai')->with([
                'kelass' => $kelass,
                'siswas' => $siswas,
                'find' => $find,
                'jml_sembunyi' => $jml_sembunyi,
                'mapels' => $mapels
            ]);
        }else{
            $kelass= kela::all();
            $siswas = kela::findOrfail($id)->siswas()->get();
            return view('detailnilai')->with([
            'kelass' => $kelass,
            'find' => $find,
            'siswas' => $siswas,
            'jml_sembunyi' => $jml_sembunyi,
            'mapels' => $mapels
        ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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
        $mapels = matapelajaran::all();
        $validatee = [];
        foreach($mapels as $mapel){
            $validatee[$mapel->mata_pelajaran] = 'nullable|integer|max:100';
        }
        $this->validate($request,$validatee);
        $nilai_siswa = siswa::find($id)->nilai_siswas()->get();
        //dd($nilai_siswa);
        foreach($nilai_siswa as $mpl){
            $ini = $mapels->find($mpl->id_matepelajaran)->mata_pelajaran;
            $mpl->update([
                'nilai' => $request->$ini
            ]);
        };
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
