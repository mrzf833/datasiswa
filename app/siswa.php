<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $fillable = ['id','nis','nama_siswa','alamat','id_kelas','foto','status'];
    public $timestamps = false;

    public function nilai_siswas(){
        return $this->hasMany(nilai_siswa::class,'id_siswa');
    }
    public function kelas(){
        return $this->belongsTo(kela::class,'id_kelas');
    }

}
