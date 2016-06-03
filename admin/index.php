<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('admin')){
		$web->desplegar('admin/index.html');
	}else{
		header('Location:..');
	}
?>