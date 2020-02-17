<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilai_siswa extends Model
{
    protected $fillable = ['id','id_siswa','id_matepelajaran','nilai'];
    public $timestamps = false;
    public function siswas(){
        $this->belongsTo(siswa::class,'id_siswa');
    }
    public function matapelajarans(){
        $this->belongsTo(matapelajaran::class,'id_matepelajaran');
    }
}
