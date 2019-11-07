<?php
session_start();
?>
<!DOCTYPE html>
<html>
<!-- Tratando erros com sessão -->
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="textoNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../principal.php">Home <span class="sr-only">(Página atual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadusuarios/usuarios.php">Cadastrar Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar Clientes</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Bem vindo:
                    Cadastre-se
                </span>
            </div>
        </nav>
        </header>
        <div class="container">
            <form class="form-signin" action="../../controllers/usuario/c_incluir_usuario.php" method="POST">
                <div>
                    <h5 class="form-signin-heading">Cadastro de Usuários:</h5>
                </div class="">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input name="nome" id="nome" type="text" placeholder="Digite seu nome" autofocus class="form-control" required/>
                    <label for="email">E-mail:</label>
                    <input name="email" id="email" type="text" placeholder="Digite seu email" class="form-control" required/>
                    <label for="celular">Celular:</label>
                    <input name="celular" id="celular" placeholder="Digite seu celular" class="form-control" required autocomplete="off"/>
                    <label for="login">Login:</label>
                    <input name="login" id="login" placeholder="Digite seu login" class="form-control" required autocomplete="off"/>
                    <label for="senha">Senha:</label>
                    <input name="senha" id="senha" type="password" placeholder="Digite sua senha" class="form-control" required/>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="../../index.php" class="btn btn-danger">Cancelar</a>
            </form>
            <p class="text-center text-danger">
                <?php
                  if(isset($_SESSION['erroNovoUsuario'])){
                     echo $_SESSION['erroNovoUsuario'];
                     unset($_SESSION['erroNovoUsuario']);
                  }
                ?>
            </p>
        </div>
    </body>
</html>