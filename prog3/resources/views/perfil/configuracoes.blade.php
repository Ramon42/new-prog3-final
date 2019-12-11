@extends('layout.nav') <!-- implementa a pagina principal -->

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

    </div>

@endsection
