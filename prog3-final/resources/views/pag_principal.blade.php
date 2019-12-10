@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-5">
                <form method="post" action="{{ route('newpost') }}" id="login_form">
                    {{ csrf_field() }}
                    <label for="textarea-newpost"></label>
                    <textarea class="form-control" id="textarea-newpost" name="conteudo" rows="2"></textarea>
                    <div class="input-group mb-3"></div>
                    <button class="btn btn-default btn-circle">Enviar</button>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-5">
            @foreach($posts as $post)
                <div class="row">
                    <div class="border border-primary p-3 mb-4 rounded bg-primary text-white shadow-p-3">
                        <p class="text-sm-left">{{ $post->username }}</p> <!-- ->nome para acessar objeto, contato['nome'] para acessar lista n objetos -->
                        <p class="text-center">{{ $post->conteudo }}</p>
                        <div class="row">
                            <div class="col-6 col-md-3"></div>
                                <div class="col-6 col-md-8">
                                    <form method="post" class="form-inline" action="/enviar_comentario">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_post" value="{{ $post->id }}">
                                        <input type="text" name="comentario" class="form-control col-8" placeholder="Comentar" >
                                        <button class="btn btn-info"> > </button>
                                    </form>
                                </div>
                            <div class="col-6 col-md-3"></div>
                        </div>
                        @foreach($comentarios as $coment)
                            @if($coment['id_post'] == $post['id'])
                                <div class="row rounded border border-secondary">
                                    <div class="col-3">
                                        FOTO
                                    </div>
                                    <div class="col-6">
                                        <p class="text-center"> {{ $coment['comentario'] }}</p>
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="alert alert-info text-center" role="alert">
                    Combinações
                </div>
                    @foreach($combinacoes as $combinacao)
                    <form method="get" action="/chat/{{ $combinacao['id_user2'] }}">
                        <div class="bg-secondary rounded-left text-white mb-3 text-center">
                            <button class="btn btn-secondary" id="btn-comb">{{ $combinacao['nome'] }}</button>
                        </div>
                    </form>
                    @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div id = "messages"></div>
        <script>
            var id_comb = document.getElementById('id_comb');
            var b = document.getElementById('btn-comb');

            b.addEventListener('click', function (){
                var user = {
                    "email" : email.value,
                    "password" : password.value,

                };
                var myheaders = new Headers({
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json'
                });
                console.log(user);
                m.innerText = "Tentou logar";

                fetch('http://localhost:8000/api/login/acessar',{
                    method: 'post',
                    headers : myheaders,
                    body : JSON.stringify(user)
                }).then(function (response){
                    response.json().then(function (data){
                        console.log(data);
                        m.innerText = data.message;
                    });
                }).catch(function (error) {
                    console.log('error', error);
                    m.innerText = error;
                });

                m.innerText = 'aguardando...';
            });
        </script>
    </div>
@endsection
