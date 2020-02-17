<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matapelajaran extends Model
{
    protected $fillable = ['id','mata_pelajaran'];
    public $timestamps = false;
    public function nilai_siswas(){
        $this->hasMany(nilai_siswa::class,'id_matepelajaran');
    }
}
