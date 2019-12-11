<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ComentarioController extends Controller
{
    public function comentar(Request $request)
    {
        $data = $request->all();
        $data['id_user'] = Auth::id();
        Comentario::create($data);
        return Redirect::to('/');
    }

    public function getComentario(int $id)
    {
        $comentarios = Comentario::where('id', '=', $id)->get();;
        return $comentarios;
    }
}
