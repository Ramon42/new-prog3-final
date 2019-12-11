<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Curso;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use SendsPasswordResetEmails;

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]))
        {
            return redirect()->route('postagens');
        }
        else{
            return redirect('/cadastrar');
        }
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
        $campus = DB::table('campuses')->get();
        return view('inicial.cadastro', compact('campus', 'cursos'));
    }

    public function register(UserStoreRequest $request)
    {
        echo 'ENTROU';
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if ($user)
        {
            Storage::disk('local')->makeDirectory($data['username']);
            return redirect('/login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }


    public function salvar()
    {

    }
}
