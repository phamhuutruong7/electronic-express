<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
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
}
