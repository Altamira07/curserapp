<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno') )
	{
		$web->desplegar('alumno/exito.html');
	}else{
		header('Location:..');
	}
?>