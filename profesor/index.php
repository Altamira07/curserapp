<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$web->desplegar('profesor/index.html');
	}else{
		header('Location:..');
	}
?>