<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShipperModel;

class ShipperController extends Controller
{
    //
    /**
     * Hàm khởi tạo của class mà sẽ được chạy ngay khi
     * khởi tạo đối tượng
     * Hàm này luôn được chạy trước các hàm trong class
     * SellerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:shipper')->only('index');
    }

    /**
     * Phương thức trả về view khi đăng nhaaph shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('shipper.dashboard');

    }

    /**
     * Phương thức trả về view để đăng ký tài khoản shipper
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

        // Khởi tạo model để lưu admin mới
        $sellerModel = new ShipperModel();
        $sellerModel->name = $request->name;
        $sellerModel->email = $request->email;
        $sellerModel->password = bcrypt($request->password);
        $sellerModel->save();

        return redirect()->route('shipper.auth.login');
    }

}



