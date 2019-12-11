<?php

namespace App\Http\Controllers;

use App\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    public function index(Request $request)
    {
        $id_chat = $request->route()->parameters();
        $mensagens = Mensagem::join('combinacaos', 'mensagems.id_combinacao', '=', 'combinacaos.id')
            ->where([
                ['combinacaos.id_user1', '=', Auth::id()],
                ['combinacaos.id_user2', '=', $id_chat]
            ])
            ->select('combinacaos.id', 'mensagems.msg')
            ->orderBy('mensagems.updated_at', 'ASC')
            ->get();
        return view('chat', compact('mensagens'));
    }
}
