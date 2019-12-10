@extends('layout.nav') <!-- implementa a pagina principal -->

@section('titulo', $show_user) <!-- troca o valor da variavel titulo para 'Contatos' -->

@section('conteudo')
    {{ $show_user->id }}
    {{ $show_user->nome }}
    {{ $show_user->username }}
    <h1>ENTROU</h1>
@endsection
