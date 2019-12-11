@extends('layout.initial_nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'Configurações') <!-- troca o valor da variavel titulo para 'Contatos' -->

<!-- COMANDOS UTEIS
composer install
composer dumpautoload -o

php artisan passport:client --personal

copy .env.example .env
php artisan key:generate
-->

@section('conteudo')
    <div class="container-fluid">
        <form method="post" action="{{ route('configs.update') }}" id="register_form">
            {{ csrf_field() }}
            <input type="hidden" id='id_usr' value="{{Auth::user()->id}}">
            <input type="hidden" id='id_campus' value="{{Auth::user()->id_campus}}">
            <input type="hidden" id='id_curso' value="{{Auth::user()->id_curso}}">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputcampus">Preferência</label>
                </div>
                <select class="custom-select" id="inputpref">
                    <option selected>Adicionar nova preferência:</option>
                    @foreach($prefs as $pref)
                        <option name='id_pref' value="{{ $pref->id }}">{{ $pref->desc_pref }}</option>
                    @endforeach
                </select>
            </div>
            <input type="button" id="btn-new-pref" class="btn btn-dark" value="Adicionar">
        </form>
        <div id='messages' style="border: thin #11400e solid; "></div>
    </div>

    <script>
        var p = document.getElementById('inputpref');
        var i = document.getElementById('id_usr');
        var cr = document.getElementById('id_curso');
        var ca = document.getElementById('id_campus');
        var b = document.getElementById('btn-new-pref');
        var m = document.getElementById('messages');
        b.addEventListener('click', function(){
            var preferencias_as_users = {
                "id_user" : i.value,
                "id_pref" : p.value,
                "id_curso" : cr.value,
                "id_campus" : ca.value
            };
            var myheaders = new Headers({
                'Content-Type': 'application/json',
                'Accept' : 'application/json'
            });
            console.log(preferencias_as_users);
        fetch('http://localhost:8000/api/configuracoes/update', {
            method: 'post',
            headers: myheaders,
            body: JSON.stringify(preferencias_as_users)
        }).then(function(response) {
            response.json().then(function(data){
                m.innerText = data.message;
            });
        }).catch(function(error) {
            m.innerText = error;
        });
        m.innerText = 'aguardando...';
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection
