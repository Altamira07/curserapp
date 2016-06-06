<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno') )
	{
		$articulos = $web->getArticulos();
		$web->asignar('articulos',$articulos);
		$web->desplegar('alumno/articulos.html');

	}else{
		header('Location:..');
	}
?>