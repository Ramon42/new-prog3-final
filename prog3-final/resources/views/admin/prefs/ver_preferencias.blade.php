@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->
@section('conteudo')
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm form-group" >
            <form>

            </form>
        </div>
        <div class="col-sm"><a href="{{ route('adm.pref.add') }}">Adicionar Preferência</a></div>
    </div>

@endsection
