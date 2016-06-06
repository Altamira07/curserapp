<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$articulos = $web->getMisArticulos($_SESSION['correo']);
		$web->asignar('articulos',$articulos);
		$web->desplegar('profesor/mis_articulos.html');
	}else{
		header('Location:..');
	}
?>