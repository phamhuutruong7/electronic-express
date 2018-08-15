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
    	$theloai = TheLoai::all();

        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'
            ]
            ,
            [
                'Ten.require'=>'Bạn chưa nhập tên loại tin',
                'Ten.unique'=>'Tên loại tin đã tồn tại',
                'Ten.min'=>'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max'=>'Tên loại tin phải có độ dài từ 3 đến 100 kí tự',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten= $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
    }
    //The first array is the error that can be happen, and the second is the error handler

    public function getSua($id)
    {
    	
    }

    public function postSua(Request $request, $id)
    {
    	
    }

    public function getXoa($id)
    {
    	$theloai = LoaiTin::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa loại tin thành công');
    }
}
