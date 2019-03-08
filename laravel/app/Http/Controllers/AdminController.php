<?php

namespace App\Http\Controllers;

use App\Model\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
     * hàm này luô dược chạy trước các hàm kahcs trong class
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->only('index');
    }

    /**
     * Phương thức trả về view khi đăng nhập admin thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view ('admin.dashboard');
    }

    /**
     * Phương thức trả về view dùng đề đăng ký tài khoản admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.auth.register');
    }

    public function store(Request $request){
        //validate dữ liệu được gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ));

        //khởi tạo model để lưu admin mới
        $adminModel = new AdminModel();
        $adminModel->name = $request->name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();

        return redirect()->route('admin.auth.login');
    }


}
