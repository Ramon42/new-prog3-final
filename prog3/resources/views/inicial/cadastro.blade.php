<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>@yield('titulo')</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Cadastre-se</h1>
                <p class="lead">Faça seu cadastro para acessar nossa rede social!</p>
            </div>
        </div>
        <form method="post" action="{{ route('site.cadastro.send') }}" id="register_form">
            {{ csrf_field() }}
            <label for="inputname">Nome completo</label>
            <input type="text" name="nome" class="form-control" id="inputname" placeholder="Nome" >
            <label for="inputusername">Seu nome de usuário</label>
            <input type="text" name="username" class="form-control" id="inputusername" placeholder="Nome de usuário" >
            <div class="input-group mb-3"></div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputcampus">Selecione seu Campus</label>
                </div>
                <select class="custom-select" name='id_campus' id="inputcampus">
                    <option selected>Qual o seu Campus?</option>
                    @foreach($campus as $cp)
                        <option  value="{{ $cp->id }}">{{ $cp->campus }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputcurso">Selecione seu Curso</label>
                </div>
                <select class="custom-select" name='id_curso' id="inputcurso">
                    <option selected>Qual o seu curso?</option>
                    @foreach($cursos as $cr)
                        <option  value="{{ $cr->id }}">{{ $cr->curso }}</option>
                    @endforeach
                </select>
            </div>

            <label for="inputemail">Endereço de E-mail</label>
            <input type="email" name="email" class="form-control" id="inputemail" placeholder="E-mail" >
            <label for="inputpassword">Senha</label>
            <input type="password" name="password" class="form-control" id="inputpassword" placeholder="Senha" >
            <input type="checkbox" name="agree" id="ckbxtermos"> Aceito os Termos
            <div class="input-group mb-3"></div>
            <input type="button" id="btncadastro" class="btn btn-dark" value="Cadastrar">
            <input type="submit">
            <a href="/login" class="btn btn-dark">Login</a>
        </form>
        <div id='messages' style="border: thin black solid; "></div>
    </div>
    <script>
        var n = document.getElementById('inputname');
        var usr = document.getElementById('inputusername');
        var ca = document.getElementById('inputcampus');
        var cr = document.getElementById('inputcurso');
        var e = document.getElementById('inputemail');
        var p = document.getElementById('inputpassword');
        var b = document.getElementById('btncadastro');
        var m = document.getElementById('messages');
        b.addEventListener('click', function(){
            var user = {
                "id_campus" : ca.value,
                "id_curso" : cr.value,
                "nome"  : n.value,
                "username" : usr.value,
                "email" : e.value,
                "password" : p.value
            };
            var myheaders = new Headers({
                'Content-Type': 'application/json',
                'Accept' : 'application/json; odata=verbose'
            });
            fetch('http://localhost:8000/api/cadastrar/send', {
                method: 'post',
                headers: myheaders,
                body: JSON.stringify(user)
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

</body>
</html>
