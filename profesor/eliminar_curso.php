<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$web->delMiCurso($_GET['id']);
		header('Location:agregar_curso.php');
	}else{
		header('Location:..');
	}
?>