<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    protected $table='theloais';
    public $timestamps=false;
    public function loaitin(){
    	return $this->hasMany('App\Loaitin','idTheLoai','id');
    }
    // vì thể loại với tin tức theo nhiều nhiều
    public function tintuc(){
    	return $this->hasManyThrough('App\Tintuc','App\Loaitin','idTheLoai','idLoaiTin','id');
    }
}
