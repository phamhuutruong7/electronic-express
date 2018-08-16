<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;
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

    function tintuc($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }

    function getDangNhap()
    {
    	return view('pages.dangnhap');
    }

    function postDangNhap(Request $request)
    {
    	 $this->validate($request, 
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],[
                'email.required'=>'Bạn chưa nhập email',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Password không được nhỏ hơn 3 kí tự',
                'password.max'=>'Password không được nhiều hơn 32 kí tự'
            ]);
    	  if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
}
