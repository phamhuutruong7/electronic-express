<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach', ['loaitin'=> $loaitin]);
    }

    public function getThem()
    {
    	return view('admin.loaitin.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên thể loại',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
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

    public function getSua($id)
    {
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    		]
    		,
    		[
    			'Ten.required'=>'Bạn chưa nhập tên thể loại',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    			'Ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
    			'Ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
    		]
    	);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
    	$theloai = LoaiTin::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa loại tin thành công');
    }
}
