<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view('inicial.index');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            $authUsr = ['user'=>Auth::user(), 'token'=>$accessToken];
            return redirect('/home');
        }
        else
        {
            return \redirect('/login');
        }
    }
}
