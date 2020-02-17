<?php

namespace App\Http\Controllers;

use App\kela;
use App\matapelajaran;
use App\siswa;
use Illuminate\Http\Request;

class crudRanking extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(403,'MAAF POSTINGAN ANDA TUJU TIDAK ADA');
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
        $a = 1;
        $find = $id;
        $kelass = kela::all();
        $jml_sembunyi = siswa::where('status', '0')->get();
        $mapels = matapelajaran::all();

        if($find !== "tersembunyi"){
            $siswass = kela::findOrfail($id)->siswas()->get();
            foreach($siswass as $siswas){
                $nilai = $siswas->nilai_siswas()->get();
                $jumlah = $nilai->sum('nilai');
                $rata = $nilai->avg('nilai');
                $siswas['jumlah'] = $jumlah;
                $siswas['rata_rata'] = $rata;
                $siswas['ranking'] = $a++;
            }
            $siswass = $siswass->sortByDesc('jumlah');
            $siswass = json_decode($siswass);

            $siswa_semua = siswa::all();
            return view('ranking')->with([
                'siswas' => $siswass,
                'kelass' => $kelass,
                'jml_sembunyi' => $jml_sembunyi,
                'mapels' => $mapels,
                'find' => $find,
                'siswass' => $siswa_semua
            ]);
        }else{
            $siswass = siswa::all();
            foreach($siswass as $siswas){
                $nilai = $siswas->nilai_siswas()->get();
                $jumlah = $nilai->sum('nilai');
                $rata = $nilai->avg('nilai');
                $siswas['jumlah'] = $jumlah;
                $siswas['rata-rata'] = $rata;
                $siswas['ranking'] = $a++;
            }
            $siswass = $siswass->sortByDesc('jumlah');
            $siswass = json_decode($siswass);

            $siswa_semua = siswa::all();
            return view('ranking')->with([
                'siswas' => $siswass,
                'kelass' => $kelass,
                'jml_sembunyi' => $jml_sembunyi,
                'mapels' => $mapels,
                'find' => $find,
                'siswass' => $siswa_semua
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
        abort(404);
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
