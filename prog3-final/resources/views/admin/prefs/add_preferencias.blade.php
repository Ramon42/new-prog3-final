@extends('layout.nav') <!-- implementa a pagina principal -->

@include ('layout._includes.topbar')
@section('titulo', 'UENP') <!-- troca o valor da variavel titulo para 'Contatos' -->
@section('conteudo')
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm form-group">
            <form method="post" action="{{ route('adm.pref.add.send') }}">
                {{ csrf_field() }}
                <label for="inputnewpref">Nova preferência</label>
                <input type="text" name="pref" class="form-control" id="inputnewpref" placeholder="Descrição">
                <input type="button" id="btncadastropref" class="btn btn-dark form-control" value="Adicionar">
            </form>
        </div>
        <div class="col-sm"></div>
    </div>
    <div class="row">
        <div id = "messages"></div>
    <script>
        var desc = document.getElementById('inputnewpref');
        var b = document.getElementById('btncadastropref');
        var m = document.getElementById('messages');

        b.addEventListener('click', function (){
            var preferencia = {
                "desc_pref" : desc.value,
            };
            var myheaders = new Headers({
                'Content-Type' : 'application/json',
                'Accept' : 'application/json'
            });
            console.log(preferencia);
            m.innerText = "Tentou Cadastrar";

            fetch('http://localhost:8000/api/adm/preferencias/add/send',{
                method: 'post',
                headers : myheaders,
                body : JSON.stringify(preferencia)
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
@endsection
