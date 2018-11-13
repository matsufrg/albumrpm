<?php require_once 'func.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">
    <title>ÁlbumRPM</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/album/album.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-4 py-4">
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <p class="text-white">Você pode <?php ?><a href="adicionar.php">Adicionar</a>, editar e excluir imagens se você estiver logado.</p>
              <h4 class="text-white">Sistema de Login</h4>
              <ul class="list-unstyled">
                <?php if (!isset($_SESSION['logado'])) { ?>
                <li><a href="login.php?id=7" class="text-white">Login</a></li>
                <li><a href="login.php?id=8" class="text-white">Registro</a></li>
              <?php } else { ?>
                <li><a href="index.php?deslogar=true" class="text-white">Deslogar</a></li>
                <li><a href="login.php" class="text-white">Meu perfil</a></li>
                <li><a href="adicionar.php" class="text-white">Adicionar Imagem</a></li>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <?php if (isset($_SESSION['login'])) { ?>
            <strong>Usuário: <?= $_SESSION['login'] ?></strong>
          <?php } ?>
            <a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Home</strong></a>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">