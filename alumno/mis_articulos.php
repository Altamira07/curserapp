<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		$articulos = $web->getMisArticulos($_SESSION['correo']);
		$web->asignar('articulos',$articulos);
		$web->desplegar('alumno/mis_articulos.html');
	}else{
		header('Location:..');
	}
?>