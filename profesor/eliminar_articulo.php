<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$web->delMiArticulo($_GET['id'],$_SESSION['correo']);
		header('Location:mis_articulos.php');
	}else{
		header('Location:..');
	}
?>