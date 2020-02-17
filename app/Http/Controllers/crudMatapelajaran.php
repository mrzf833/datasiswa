<?php

namespace App\Http\Controllers;

use App\kela;
use App\matapelajaran;
use App\nilai_siswa;
use App\siswa;
use Illuminate\Http\Request;

class crudMatapelajaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = matapelajaran::all();
        $kelass = kela::all();
        return view('mapel')->with([
            'kelass' => $kelass,
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
        //dd($request->all());
        $this->validate($request,[
            'mapel' => 'string|min:1|max:30|required'
        ]);
        $mapel = matapelajaran::create([
            'mata_pelajaran' => $request->mapel
        ]);
        $siswas = siswa::all();
        foreach($siswas as $siswa){
            nilai_siswa::create([
                'id_siswa' => $siswa->id,
                'id_matepelajaran' => $mapel->id,
                'nilai' => null
            ]);
        }
        return back()->with('sukses','Mata Pelajaran Sukses Di Tambahkan');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        matapelajaran::findOrfail($id)->delete();
        return back()->with('sukses','Mata Pelajaran Sukses Di Hapus');
    }
}
