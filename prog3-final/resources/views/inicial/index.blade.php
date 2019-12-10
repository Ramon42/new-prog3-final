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
                <h1 class="display-4">Conecte-se</h1>
                <p class="lead"></p>
            </div>
        </div>
        <form method="post" action="{{ route('site.login.acessar') }}" id="login_form">
            {{ csrf_field() }}
            <label for="inputemaillogin">Endereço de E-mail</label>
            <input type="email" name="email" class="form-control" id="inputemaillogin" placeholder="E-mail" >
            <label for="inputpasswordlogin">Senha</label>
            <input type="password" name="password" class="form-control" id="inputpasswordlogin" placeholder="Senha" >
            <div class="input-group mb-3"></div>
            <input type="button" id="btnlogin" class="btn btn-dark" value="Logar Script">
            <button type="button" class="btn btn-dark">Login</button>
        </form>
        <div id='messages' style="border: thin #11400e solid; "></div>
    </div>
    <script>
        var e = document.getElementById('inputemaillogin');
        var p = document.getElementById('inputpasswordlogin');
        var b = document.getElementById('btnlogin');
        var m = document.getElementById('messages');
        b.addEventListener('click', function(){
            var user = {
                "email" : e.value,
                "password" : p.value
            };
            var myheaders = new Headers({
                'Content-Type': 'application/json',
                'Accept' : 'application/json'
            });
            fetch('http://localhost:8000/api/login/acessar', {
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
