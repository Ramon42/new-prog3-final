<?php

namespace App\Http\Controllers;

use App\Combinacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombinacaoController extends Controller
{
    public function index()
    {

    }
    public function aprovar(Request $request)
    {
        $request->validate([
            'id_user2' => 'required',
            'id_tipo' => 'required'
        ]);
        $data = $request->all();
        $data['id_user1'] = Auth::id();
        Combinacao::create($data);
        return redirect('/sugestoes');
    }
}
