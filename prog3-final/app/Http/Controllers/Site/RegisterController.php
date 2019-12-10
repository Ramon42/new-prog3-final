<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('inicial.cadastro');
    }
    public function cadastrar(Request $request)
    {
        $request->flash();
        $request->validate([
            'id_campus'=> 'required',
            'id_curso'=>'required',
            'nome'=>'required',
            'username'=>'required|unique:users',
            'email'=>'email|required|unique:users',
            'password'=>'required|min:8',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if($user)
        {
            return redirect('/login');
        }
    }
}
