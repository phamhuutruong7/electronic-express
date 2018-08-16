<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
class PagesController extends Controller
{
    //
    function __construct()
    {
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
    	//to share the variable 'theloai', that make we dont have to call $theloai = TheLoai::all(); in all other functions
    }

    function trangchu()
    {
    	//$theloai = TheLoai::all();
    	return view('pages.trangchu');
    }

    function lienhe()
    {
    	//$theloai = TheLoai::all();
    	return view('pages.lienhe');
    }

    function loaitin($id)
    {	
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	//paginate() to set the number of news per page
    	return view('pages.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
}
