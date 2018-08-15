<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request)
    {
    	
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
            }

            while(file_exist("upload/tintuc".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }   
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao','Thêm tin tức thành công');

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
    	
    }
}
