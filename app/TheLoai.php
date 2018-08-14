<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";

    public function loaitin()
    {
    	return $this->hasMany('App\LoaiTin','idTheLoai', 'id');
    	//The first argument is the Model's name,  the second is the Foreign key, and the last is primary key
    }

    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
