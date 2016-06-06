<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor') )
	{
		$articulos = $web->getArticulos();
		$web->asignar('articulos',$articulos);
		$web->desplegar('profesor/articulos.html');

	}else{
		header('Location:..');
	}
?>