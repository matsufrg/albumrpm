<?php require_once 'inc/header.php';
if (!isset($_SESSION['logado'])) {
	$categoria = listarCategoria(true);
	?>
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4">
	<?php
	if ($_GET['id']) { 
	foreach ($categoria as $i) {
		if ($_GET['id'] == $i['id']) {
		?>
		<h1 class="text-center"><?=$i['nome']?></h1>
		<form action="#" method="POST">
			<label for="Login">Login</label>
			<input class="form-control" type="text" name="Login" id="Login">
			<label for="Senha">Senha</label>
			<input class="form-control" type="password" name="Senha" id="Senha">
			<?php if ($_GET['id'] == 8){?>
			<label for="Email">Email</label>
			<input class="form-control" type="email" name="Email" id="Email">
			<strong>Ou se já tiver conta <a class="nav-link" href="login.php?id=7">Logue aqui</a></strong>
		<?php } ?>
			<input class="btn btn-primary mt-2" type="submit" name="btn-<?=$i['nome']?>" value="<?=$i['nome']?>">
		</form>

<?php } } } ?>
</div>	
<div class="col-4"></div>
</div>
<?php 
if (isset($_POST['btn-Registro'])) {
	registrar($_POST['Login'], $_POST['Senha'], $_POST['Email']);
} elseif (isset($_POST['btn-Login'])) {
	logar($_POST['Login'], $_POST['Senha']);
}
	} else {
	$usuarios = listarUsuario($_SESSION['id']);

	foreach ($usuarios as $i) { 
		?>
		<div class="row">
			<div class="col-3"></div>
			<div class="col-6">
		<h1 class="text-center">Perfil</h1>
		<div class="input-group mb-1">
			<div class="input-group-prepend">
	  	    	<span class="input-group-text">Login: <?=$i['login']?></span>
			</div>
		</div>
		<div class="input-group mb-1">
			<div class="input-group-prepend">
	  	    	<span class="input-group-text">Email: <?=$i['email'] == "" ? " Email não registrado" : $i['email'];?></span>
			</div>
		</div>
		</div>
		<div class="col-3"></div>
	</div>
<?php } }
?>
<?php require_once 'inc/footer.php'; ?>