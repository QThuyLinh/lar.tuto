<?php

namespace App\Http\Controllers\Auth\Shipper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:shipper')->except('logout');
    }

    /**
     * Phương thức này trả về view để đăng nhập cho shipper
     */
    public function login(){
        return view('shipper.auth.login');
    }

    /**
     * Phương thức này dùng để đăng nhập cho shipper lấy thông tin từ form
     * có METHOD là POST
     */
    public function loginShipper(Request $request){
        //validate dữ liệu đăng nhập
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));

        //Đăng nhập
        if(Auth::guard('shipper')->attempt(
            [ 'email' => $request->email, 'password' => $request->password], $request->remember
        )){
            //nếu đăng nhập thành công thì sẽ chuyển hướng về view dashboard cua admin
            return redirect()->intended(route('shipper.dashboard'));
        }
        //nếu đăng nhập thất bại thì quay trở về form đăng nhập
        //với giá trị của hai ô input cũ là email và remember
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    /**
     * Phương thức này dùng để đăng xuất
     */
    public function logout(){
        Auth::guard('shipper')->logout();

        //chuyển hướng về trang login của admin
        return redirect()->route('shipper.auth.login');
    }
}


