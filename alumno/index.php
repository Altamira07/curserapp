<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		$web->desplegar('alumno/index.html');
	}else{
		header('Location:..');
	}
?>