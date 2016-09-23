<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
  //  public $timestamps=false; // khóa lại vì tôi muốn lấy thời gian bình luận
    public function tintuc()
    {
    	return $this->belongsto('App\tintuc','idTinTuc','id');
    }
}
