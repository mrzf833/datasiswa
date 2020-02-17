<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kela extends Model
{
    protected $fillable = ['id','kelas'];
    public $timestamps = false;

    public function siswas(){
        return $this->hasMany(siswa::class,'id_kelas');
    }
}
