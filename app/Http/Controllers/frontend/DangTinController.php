<?php

namespace App\Http\Controllers\frontend;
use App\models\BatDongSan;
use App\models\HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Provinces;
use App\models\Districts;
use App\models\Wards;
use App\models\DanhMuc;
use App\models\ChiTietBatDongSan;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class DangTinController extends Controller
{
    //
    public function dang_tin(){

        $category=DanhMuc::where('idDanhMucCha','=','-1')->orderBy('idDanhMuc','asc')->get();
        $city=Provinces::orderBy('id','ASC')->get();
        $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
        $date=$dateTime->toDateString();
        $date_end=$dateTime->addDays(7)->toDateString();
        return view('frontend.dangtin')->with(compact('city'))->with(compact('category'))->with(compact('date'))->with(compact('date_end'));
    }
}
