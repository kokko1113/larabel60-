<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view("login");
    }
    public function dash(){
        $items=Item::get();
        return view("dash",compact("items"));
    }
    public function check(Request $request){
        $check=$request->only("name","password");
        if(Auth::attempt($check)){
            $request->session()->regenerate();
            return redirect(route("dash"));
        }
        return back()->withErrors(["message"=>"アカウントまたはパスワードが正しくありません"]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect(route("login"));
    }
    
}
