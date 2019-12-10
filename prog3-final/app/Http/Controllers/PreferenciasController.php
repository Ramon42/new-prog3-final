<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrefUpdateRequest;
use App\Preferencia;
use App\Preferencias_as_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PreferenciasController extends Controller
{
    public function index()
    {
        return view('admin.prefs.ver_preferencias');
    }

    public function index_add()
    {
        return view('admin.prefs.add_preferencias');
    }

    public function add(Request $request)
    {
        $data = $request->all();
        Preferencia::create($data);
        return Redirect::to('/adm/preferencias');
    }

    /*
    public function update(PrefUpdateRequest $request, $id)
    {
        $pref = Preferencia::find($id);
        if (!isset($pref)){
            echo("Preferência não encontrada") ;
        }
        $data = $request->validated();
        $success = $pref->update($data);
        if ($success){
            echo("Preferência alterada com sucesso");
        } else {
            echo("Erro ao alterar a Preferência") ;
        }
    }
*/
    public function find_matching()
    {
        $id = Auth::id();
        $prefs = Preferencias_as_users::where('id_user', '=', $id)->select('id_pref')->get();
        $sugestoes = [];
        foreach ($prefs as $pref)
        {
            foreach (Preferencias_as_users::where([
                ['id_pref', '=', $pref['id_pref'] ],
                ['id_user', '!=', $id]])
                         ->join('users', 'id_user', '=', 'users.id')
                         ->join('preferencias', 'id_pref', '=', 'preferencias.id')
                         ->select('users.username', 'users.id', 'id_pref', 'preferencias.desc_pref')
                         ->get() as $row)
            {
                $sugestao = (object)array(
                    "id" => $row['id'],
                    "desc_pref" => $row['desc_pref'],
                    'username' => $row['username']
                );
                array_push($sugestoes, $sugestao);
            }
            /*
            dd($sugestoes);

            array_push($sugestoes, Preferencias_as_users::where([
                                            ['id_pref', '=', $pref['id_pref'] ],
                                            ['id_user', '!=', $id]])
                                            ->join('users', 'id_user', '=', 'users.id')
                                            ->join('preferencias', 'id_pref', '=', 'preferencias.id')
                                            ->select('users.username', 'users.id', 'id_pref', 'preferencias.desc_pref')
                                            ->get());
            */
        }

        return view('procurar_combinacoes', compact('sugestoes'));

        /*
        $list_prefs = DB::table('preferencias_as_users')
            ->where('preferencias_as_users.id_user', '=', $id);
        dd($list_prefs);

        $list_all = DB::table('preferencias_as-users')
            ->where('preferencias_as_users.id_user', '!=', $id);

        $sugestoes = [];
        foreach ($list_prefs as $pref)
        {
            echo $pref->id_pref;
            foreach ($list_all as $sug)
            {
                if($pref->id_pref == $sug->id_pref)
                {
                    echo "TESTE";
                }
            }
        }
        */
    }
}
