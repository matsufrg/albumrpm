<?php require_once 'inc/header.php';
	if (isset($_SESSION['logado'])) {
?>
<!-- Formulário -->
<div class="container">
<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
<?php 
$conteudo = listarConteudo(9, NULL);
foreach ($conteudo as $i) { 
	if ($i['id'] == $_GET['id']) {
	?>
	<br>
	
	<h1><?=$i['titulo']?></h1>
	<img class="img-fluid" width="500" height="200" src="img/<?=$i['fotos']?>" alt="Card image cap">
	<p><?=$i['resumo']?></p>

<?php } } ?>
<?php
	if (isset($_GET['id'])) { ?>
		<h1 class="text-center">Alterar Informações</h1>
		<form action="#" method="POST">
		<label for="titulo">Novo título:</label>
		<input class="form-control" type="text" name="titulo" id="titulo">
		<label for="resumo">Novo resumo:</label>
		<input class="form-control" type="text" name="resumo" id="resumo">
		<label for="descricao">Nova descrição:</label>
		<textarea class="form-control" name="descricao" id="descricao"></textarea><br>
		<input class="btn" type="submit" name="btn-enviar" value="Editar">
		
		</form>
	<?php } else {
		header("location: index.php");
		exit();
	} ?>
	<a class="btn text-center" href="index.php">Voltar</a>
</div>
	<div class="col-3"></div>
</div>
<!-- Fim do formulário -->
<?php
// Ação
	if (isset($_POST['btn-enviar'])) {
		editarConteudo($_POST['resumo'], $_POST['titulo'], $_GET['id'], $_POST['descricao']);
		header('Location: index.php');
		exit();
	}
 ?>

</div>
<?php } else {
	header("location: index.php");
	exit();
} require_once 'inc/footer.php'; ?>