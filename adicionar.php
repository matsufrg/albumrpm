<?php require_once 'inc/header.php'; if (isset($_SESSION['logado'])){ 
	if (isset($_POST['enviar'])) {
		$imagem = pegarImagem($_FILES['imgUpload']);
		adicionarImagem($_POST['resumo'], $_POST['titulo'], $imagem, $_POST['descricao']);
		header('location: index.php');
		exit();
	}
	?>
<div class="row">
	<div class="col-4"></div>
	<div class="col-4">
			<h2 class="text-center">Registrar imagem: </h2>
<form action="#" method="POST" enctype="multipart/form-data">
	<label for="titulo">Título: </label>
	<input class="form-control" type="text" name="titulo" id="titulo" required><br>
	<label for="resumo">Resumo:</label>
	<input class="form-control" type="text" name="resumo" id="resumo" required><br>
	<label for="descricao">Descrição</label>
	<textarea class="form-control" type="text" name="descricao" id="descricao" required></textarea><br>
	<label for="imgupload"></label>
	<input type="file" name="imgUpload" id="imgupload" required><br><br>
	<input class="btn btn-primary" type="submit" name="enviar">
</form>
</div>
<div class="col-4"></div>
</div>

<?php require_once 'inc/footer.php'; } else { header('location: index.php'); exit();} ?>