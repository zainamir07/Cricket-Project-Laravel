<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    public function login(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
          $creditials = $request->only('email', 'password');
          if(Auth::guard('admin')->attempt($creditials, $request->remember)){
            return redirect()->route('admin.home');
          }else{
            return redirect()->route('admin.login')->with('error', 'Failed to process');
          }
    }
    public function logout(){
        if(Auth::guard('admin')->logout()){
            return redirect()->route('admin.login');
        }
    }
}
