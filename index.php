<?php require_once 'inc/header.php';  
  if (isset($_GET['deslogar'])) {
    deslogar();
  }
  if (isset($_GET['excluir'])) {
    excluirConteudo($_GET['excluir']);
  }
?>
      <section class="jumbotron text-center">
        <div class="container">
          
          <h1 class="jumbotron-heading mt-3">Álbuns:</h1>
          <p>
            <?php 
            $categoria = listarCategoria(true);
            foreach($categoria as $i){
              # Listar categorias ( tirando o login e a senha )
              if ($i['id'] < 5) {
            ?>
            <a href="index.php?id=<?=$i['id']?>" class="btn btn-primary my-2"><?=$i['nome']?></a>
          <?php } }?>
          <br>
          </p>
        </div>
      </section>
      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <?php 
            if (isset($_GET['id'])) {
              $conteudo = listarConteudo(100, $_GET['id']);
            } else {
               $conteudo = listarConteudo(100, NULL);
            }
            foreach($conteudo as $i){
            ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" width="250" height="250" src="img/<?=$i['fotos']?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="text-center"><?= $i['titulo'] ?></h5>
                  <p class="card-text"><?=$i['resumo']?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="detalhes.php?id=<?=$i['id']?>" type="button" class="btn btn-sm btn-outline-secondary">Ver detalhes</a>
                      <?php if (isset($_SESSION['logado']) && $i['categoria_id'] >= 4) { ?>
                      <a href="editar.php?id=<?=$i['id']?>" type="button" class="btn btn-sm btn-outline-secondary">Editar</a>
                      <a href="index.php?excluir=<?=$i['id']?>" type="button" class="btn btn-sm btn-outline-secondary">Excluir</a>
                    <?php } ?>
                    </div>
                    <small class="text-muted"><?=dataPadrao($i['data_publicacao']);?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
      <?php require_once 'inc/footer.php' ?>