<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaitin extends Model
{
    protected $table='loaitins';
    protected $fillable=['Ten','TenKhongDau'];
    public $timestamps=false;

    public function theloai()
    {
    	return $this->belongsto('App\TheLoai','idTheLoai','id');
    }
    public function tintuc()
    {
    	return $this->hasMany('App\Tintuc','idLoaiTin','id');
    }
}
