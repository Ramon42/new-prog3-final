@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->

@section('conteudo')
    <div class="bg-light">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-5">
                @foreach($sugestoes as $sugestao)
                    <div class="row">
                        <div class="col-sm col-lg-3"></div>
                        <div  class="card col-sm col-lg-6">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Sugestão por preferência: {{ $sugestao->desc_pref }}</p>
                                <button type="button" class="btn btn-danger">Nope</button>
                                <button type="button" class="btn btn-success">Yep</button>
                            </div>
                        </div>
                        <div class="col-sm col-lg-3"></div>
                    </div>
                @endforeach
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="alert alert-info text-center" role="alert">
                    Mensagens
                </div>
                <div class="bg-secondary rounded-left text-white">
                    Teste um
                </div>
            </div>
        </div>
    </div>
@endsection
