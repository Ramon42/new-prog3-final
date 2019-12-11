@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-3 bg-dark"></div>
            <div class="col-6 justify-content-center">
                @foreach($mensagens as $msg)
                <div class="row rounded border border-secondary">
                    {{ $msg['msg'] }}
                </div>
                @endforeach
                <div class="row d-flex">
                    <nav class="bg-light">
                        <form method="post" action="" id="chat_form" class="form-inline">
                            {{ csrf_field() }}
                            <input type="text" name="msg-chat" class="form-control" id="inputemaillogin" placeholder="Digite uma mensagem" >
                            <button type="button" class="btn btn-dark"> > </button>
                        </form>
                    </nav>
                </div>
            </div>
            <div class="col-3 bg-dark"></div>
        </div>
    </div>

@endsection
