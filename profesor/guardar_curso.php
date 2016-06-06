<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$web->upCurso($_GET['id'],$_GET['curso'],$_GET['descripcion']);
		$id = $_GET['id'];
	}else{
		header('Location:..');
	}
?>