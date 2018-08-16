<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class PagesController extends Controller
{
    //
    function __construct()
    {
    	$theloai = TheLoai::all();
    	view()->share('theloai',$theloai);
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
