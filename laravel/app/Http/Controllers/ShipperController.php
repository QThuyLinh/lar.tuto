<?php

namespace App\Http\Controllers;

use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    //
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
     * hàm này luô dược chạy trước các hàm kahcs trong class
     * SellerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:shipper')->only('index');
    }

    /**
     * Phương thức trả về view khi đăng nhập shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view ('shipper.dashboard');
    }

    /**
     * Phương thức trả về view dùng đề đăng ký tài khoản shipper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('shipper.auth.register');
    }

    public function store(Request $request){
        //validate dữ liệu được gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ));

        //khởi tạo model để lưu shipper mới
        $shipperModel = new ShipperModel();
        $shipperModel->name = $request->name;
        $shipperModel->email = $request->email;
        $shipperModel->password = bcrypt($request->password);
        $shipperModel->save();

        return redirect()->route('shipper.auth.login');
    }


}