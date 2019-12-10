<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Curso;
use App\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use Defuse\Crypto\File;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use SendsPasswordResetEmails;

    public function index()
    {
        return view('inicial.index');
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt($data))
        {
            dd(Auth::attempt($data));
            return redirect('/login');
        }
        $user = Auth::user();
        $user->accessToken = $user->createToken('authToken')->accessToken;
        return redirect('/');
    }

    public function ver($username = null)
    {
        if (is_null($username)) //arrumar para entrar no próprio perfil
        {
            $show_user = User::where('username','=', $username)->firstOrFail();
            if (isset($show_user))
            {
                return view('perfil.user', compact('show_user'));
            }
            else
            {
                return $this->sendError("Usuário não encontrado", 404);
            }
        }
        $show_user = User::where('username','=', $username)->firstOrFail();

        if (isset($show_user))
        {
            return view('perfil.user', compact('show_user'));
        }
        else
        {
            return $this->sendError("Usuário não encontrado", 404);
        }
    }

    public function cadastrar()
    {
        $cursos = Curso::all();
        $campus= Campus::all();
        $data = [
            'cursos'=>$cursos,
            'campus'=>$campus
        ];
        return view('inicial.cadastro', compact('campus'), compact('cursos'));
    }

    public function register(UserStoreRequest $request)
    {
        echo 'ENTROU';
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if ($user) {
            Storage::disk('local')->makeDirectory($data['username']);
            return redirect('/login');
        }
    }
    public function logout()
    {
        $user = Auth::user();
        $userTokens = $user->tokens;
        foreach($userTokens as $token) {
            $token->revoke();
        }
    }


    public function salvar()
    {

    }
}
