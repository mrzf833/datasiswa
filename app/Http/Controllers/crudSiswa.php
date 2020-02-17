<?php

namespace App\Http\Controllers;

use App\kela;
use App\matapelajaran;
use App\nilai_siswa;
use App\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class crudSiswa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jml_sembunyi = siswa::where('status', '0')->get();
        $siswas = siswa::all();
        //dd($siswas);
        $kelass = kela::all();
        return view('siswa')->with([
            'siswas' => $siswas,
            'kelass' => $kelass,
            'jml_sembunyi' => $jml_sembunyi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jml_sembunyi = siswa::where('status', '0')->get();
        $kelass = kela::all();
        return view('createSiswa')->with([
            'kelass'=> $kelass,
            'jml_sembunyi' => $jml_sembunyi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nis' => 'required|min:8|max:8',
            'alamat' => 'required',
            'kelas' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
            $filename = date('dmY') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->storeAs('images', $filename);
            $siswa = siswa::create([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama,
                'id_kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'foto' => $filename,
                'status' => $request->status
            ]);
            foreach(matapelajaran::all() as $mapel){
                $siswa->nilai_siswas()->create([
                    'id_matepelajaran' => $mapel->id
                    ]);
            };
            return back()->with('sukses','DATA DAN FOTO SUKSES DI UPLOAD');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find = $id;
        $jml_sembunyi = siswa::where('status', '0')->get();
        if($find === "tersembunyi"){
            $kelass = kela::all();
            $siswas = siswa::all();
            return view('siswa')->with([
                'kelass' => $kelass,
                'siswas' => $siswas,
                'find' => $find,
                'jml_sembunyi' => $jml_sembunyi
            ]);
        }else{
            $kelass= kela::all();
            $siswas = kela::findOrfail($id)->siswas()->get();
            return view('siswa')->with([
            'kelass' => $kelass,
            'find' => $find,
            'siswas' => $siswas,
            'jml_sembunyi' => $jml_sembunyi
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
        $this->validate($request, [
            'nama' => 'required',
            'nis' => 'required|min:8|max:8',
            'alamat' => 'required',
            'kelas' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $siswa= siswa::find($id);
        if(isset($request->image)){ //pengecekan bahwa image berubah maka akan menjalankan fungsi dibawah ini
            $filename = date('dmY') . time() . '.' . $request->image->getClientOriginalExtension();
            Storage::delete('images/' . $siswa->foto);
            $request->file('image')->storeAs('images', $filename);
            $siswa->update([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama,
                'id_kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'foto' => $filename,
                'status' => $request->status
            ]);
            return back()->with('sukses','DATA DAN FOTO SUKSES DI UPDATE');
        }else{ //pengecekan bahwa image tidak berubah maka akan menjalankan fungsi dibawah ini
            $siswa->update([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama,
                'id_kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'status' => $request->status
            ]);
            return back()->with('sukses','DATA SUKSES DI UPDATE');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = siswa::find($id);
        Storage::delete('images/' . $siswa->foto);
        $siswa->delete();
        return back()->with('sukses','Data anda berhasil dihapus');
    }
}
