<?php

namespace App\Http\Controllers;

use App\Combinacao;
use App\Comentario;
use App\Http\Requests\NewPostRequest;
use App\Mensagem;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function nova_postagem(Request $request)
    {
        $data = $request->all();
        $data['id_user'] = Auth::id();
        Post::create($data);
        return Redirect::to('/sugestoes');
    }

    public function ver_feed()
    {
        /*
        $posts = DB::table('posts')
            ->join('users', 'id_user', '=', 'users.id')
            ->select('posts.id',  'users.username', 'posts.conteudo')
            ->get();
*/
        $id = Auth::id();
        $posts = Post::join('users', 'posts.id_user', 'users.id')
            ->select('posts.id',  'users.username', 'posts.conteudo')
            ->orderBy('posts.updated_at', 'DESC')
            ->get();

        $combinacoes = Combinacao::join('users', 'combinacaos.id_user2', 'users.id')
            ->where('id_user1', '=', $id)
            ->get();

        $comentarios = [];

        foreach ($posts as $row)
        {
            foreach (Comentario::where('id_post', '=', $row['id'])->get() as $coment) {
                $comentario = array(
                    "id_user" => $coment['id_user'],
                    "id_post" => $coment['id_post'],
                    "comentario" => $coment['comentario']);
                array_push($comentarios, $comentario);
            }
        }

/*
        foreach ($posts as $post)
        {
            foreach ($comentarios as $coment)
            {
                if ($post['id'] == $coment['id_post'])
                {
                    $comentarios = array(
                        "id_user" => $coment['id_user'],
                        "id_post" => $coment['id_post'],
                        "comentario" => $coment['comentario']);
                    array_push($data, $comentarios);
                }
            }

        }
*/
        return view('pag_principal', compact('posts', 'comentarios', 'combinacoes'));
    }
}
