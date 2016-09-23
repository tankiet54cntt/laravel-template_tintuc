<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    protected $table='tintucs';

    public function loaitin(){
    	return $this->belongsto('App\Loaitin','idLoaiTin','id');
    }

    public function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }

    public function user()
    {
    	return $this->belongsto('App\User','idUser','id');
    }
}
