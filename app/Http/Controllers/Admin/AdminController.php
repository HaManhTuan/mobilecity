<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class AdminController extends Controller
{
  public function login()
  {
    return view('backend.auth.login');
  }
  public function dangnhap(Request $req)
  {
    //$data = $req->all();
    if (Auth::attempt(['email' =>$req->email, 'password' => $req->pass, 'status' => '1'])) {
          $msg = [
              'status' => '_success',
              'msg'    => 'Loading ...'
          ];
          return response()->json($msg);
    }
    else {
            $msg = [
              'status' => '_error',
              'msg'    => 'Tài khoản hoặc mật khẩu sai
              '
          ];
          return response()->json($msg);
    }
  }
  public function register()
  {
     return view('backend.auth.register');
  }
  public function dangki(Request $req)
  {
    $check = User::where('email',$req->email)->count();
    if ($check > 0) {
      $msg = [
          'status' => '_error',
          'msg'    => 'Email này đã có người dùng. '
          ];
        return response()->json($msg);
    }
    else
    {
      $user = new User();
      $user->name = $req->name;
      $user->email = $req->email;
      $user->password = Hash::make($req->pass);
      
      if ($user->save()) {
          $msg = [
          'status' => '_success',
          'msg'    => 'Bạn đã đằng kí tài khoản thành công'
          ];
          return response()->json($msg);
      }
      else
      {
        $msg = [
          'status' => '_error',
          'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
          ];
        return response()->json($msg);
      }
    }
  }
}
