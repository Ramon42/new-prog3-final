@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->

@section('conteudo')
    <div>
        <div class="row">
            <div class="col-3"></div>

            <div class="col-5"></div>
        </div>
    </div>
@endsection
