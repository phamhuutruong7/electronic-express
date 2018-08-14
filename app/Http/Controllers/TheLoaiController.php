<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai'=> $theloai]);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|max:100'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên thể loại',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
    			'Ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
    		]);
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    	
    }
    //The first array is the error that can be happen, and the second is the error handler

    public function getSua()
    {
    	return view('admin.theloai.sua');
    }
}
