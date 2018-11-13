<?php require_once 'inc/header.php' ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-6 text-center">
<?php
$conteudo = listarConteudo(9, NULL);
if (isset($_GET['id'])) {
foreach($conteudo as $i) {
		if ($_GET['id'] == $i['id']){
	?>
<h1><?=$i['titulo']?></h1>
<img class="img-fluid" width="800" height="600" src="img/<?=$i['fotos']?>" alt="<?=$i['titulo']?>">
<p><?= $i['descricao']?></p>
<a class="btn" href="index.php">Voltar</a>
<?php } } } else {
	header("location: index.php");
    exit();
} ?>
</div>

<div class="col-md-4">
	<h2 class="text-center mt-3">Últimas fotos:</h2>
	<?php $conteudo = listarConteudo(7, NULL);
foreach ($conteudo as $i) {
 ?>
    <div class="list-group">
    <a href="detalhes.php?id=<?=$i['id']?>" class="list-group-item list-group-item-action flex-column align-items-start <?php if ($_GET['id'] == $i['id']){ echo "active"; } ?>">
    <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1"><?=$i['titulo']?></h5>
    <small><?=dataPadrao($i['data_publicacao']);?></small>
    </div>
    <p class="mb-1"><?=$i['resumo']?></p>
    <small></small>
    </a>
</div>
<?php }  ?>
</div>


<?php require_once 'inc/footer.php' ?>