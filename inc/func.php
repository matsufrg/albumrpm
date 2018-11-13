<?php
// Sessão
session_start();
function clear($var, $conexao){
	// SQL
	$var = mysqli_escape_string($conexao, $var);
	// XSS
	$var = htmlspecialchars($var);
	return $var;
}
function conectarBanco() {
	$servername = "thzz882efnak0xod.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	$username = "x3hvd02j9ejm0uz6";
	$senha = "qcl9z6sww4nbsly2";
	$dbname = "s0vt59oowb6bc5r4";
	$port = "3306";
	$conexao = mysqli_connect($servername, $username, $senha, $dbname, $port);
	mysqli_set_charset($conexao, "utf8");
	return $conexao;
}
function listar($sql){
	$conexao = conectarBanco();
	$resultado = mysqli_query($conexao, $sql);
	$arr = NULL;
	while ($linha = mysqli_fetch_assoc($resultado)){
		$arr[] = $linha;
	}
	return $arr;
}
function pegarConteudo($sql){
	$conexao = conectarBanco();
	$resultado = mysqli_query($conexao, $sql);
	$var = NULL;
	if ($linha = mysqli_fetch_assoc($resultado)) {
		$var = $linha;
	}
	return $var;
}

function listarCategoria($ativo){
	$conexao = conectarBanco();
	$sql = "SELECT * FROM categoria";
	if ($ativo == 1) {
		$sql .= " WHERE ativo = $ativo";
	}
	$arr = listar($sql);
	return $arr;
}

function listarConteudo($quantidade, $id) {
	$conexao = conectarBanco();
	$sql = "SELECT c.*, g.arquivo as fotos FROM conteudo c  inner join galeria g on c.id = g.conteudo_id";
		if (!is_null($id)) {
	$sql .= " WHERE categoria_id = $id"; 
}
	$sql .= " ORDER BY data_publicacao DESC";
	if ($quantidade > 0) {
		$sql .= " LIMIT $quantidade";
	}
	$arr = listar($sql);
	return $arr;
}
function dataPadrao($data){
	return date('d/m/Y H:i', strtotime($data));
}
function editarConteudo($resumo, $titulo, $id, $descricao){
	$conexao = conectarBanco();
	$resumo = clear($resumo, $conexao);
	$titulo = clear($titulo, $conexao);
	$descricao = clear($descricao, $conexao);
	$sql = "UPDATE conteudo SET resumo = '$resumo', titulo = '$titulo', descricao = '$descricao' where id = $id";
	$resultado = mysqli_query($conexao, $sql);
}

function logar($login, $senha){
	$conexao = conectarBanco();
	$login = clear($login, $conexao);
	$senha = clear($senha, $conexao);
	$sql = "SELECT * FROM usuario WHERE login = '$login' and senha = '$senha'";
	$resultado = mysqli_query($conexao, $sql);
	$linha = mysqli_fetch_assoc($resultado);
	if (mysqli_affected_rows($conexao) >= 1) {
		$_SESSION['logado'] = true;
		$_SESSION['id'] = $linha['id'];
		header("location: index.php");
		exit();
	}

}
function registrar($login, $senha, $email){
	$conexao = conectarBanco();
	$login = clear($login, $conexao);
	$senha = clear($senha, $conexao);
	$email = clear($email, $conexao);
	$sql = "INSERT INTO usuario VALUES (NULL, '$login', '$email', '$senha', 1)";
	$resultado = mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) >= 1) {
		header("location: login.php?id=7");
		exit();
}
}
function listarUsuario($id){
	$conexao = conectarBanco();
	$sql = "SELECT * FROM usuario where id = $id";
	$arr = listar($sql);
	return $arr;
}
function deslogar(){
	session_start();
	session_unset();
	session_destroy();
	header("location: index.php");
	exit();
}
function adicionarImagem($resumo, $titulo, $arquivo, $descricao){
	$conexao = conectarBanco();
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d H:i');
	$resumo = clear($resumo, $conexao);
	$titulo = clear($titulo, $conexao);
	$arquivo = clear($arquivo, $conexao);
	$descricao = clear($descricao, $conexao);
	$sql = "INSERT INTO conteudo VALUES (null, '$titulo', '$resumo', '$descricao', '$data', 1, 4);";
	$resultado = mysqli_query($conexao, $sql);
	$id = mysqli_insert_id($conexao);
	$_SESSION['id'] = $id;
	$sql = "INSERT INTO galeria VALUES (null, '$titulo', '$resumo', '$arquivo', 1, $id)";
	$resultado = mysqli_query($conexao, $sql);
	echo "<script>alert('Parabéns, você registrou a imagem')</script>";
}
function pegarImagem($file){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($file['error']) {
                echo 'Ocorreu um erro ao efetuar o upload';
                exit;
            } 
            $dirUpload = 'img';
            if (!is_dir($dirUpload)) {
                mkdir($dirUpload);
            } 
            $ext = ltrim(substr($file['name'], strrpos($file['name'], '.')), '.');
            $extensoes = array('jpg', 'jpeg', 'png');
            if (!in_array($ext, $extensoes)) {
                echo 'Não é imagem';
                return false;
                exit;
            }
            $imgName = md5(uniqid()) . time() . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dirUpload . DIRECTORY_SEPARATOR . $imgName)) {
               	return $imgName;
            } else {
                return false;
            }
        }
}
function excluirConteudo($id){
	$conexao = conectarBanco();
	$id = clear($id, $conexao);
	$sql = "DELETE FROM conteudo where id = $id";
	$resultado = mysqli_query($conexao, $sql);
	$sql = "DELETE FROM galeria where conteudo_id = $id";
	$resultado = mysqli_query($conexao, $sql);
}