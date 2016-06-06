<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		if (isset($_GET['id']) && !empty($_GET['id'])){
			$web->pdfTemario($_GET['id']);
		}
	}else{
		header('Location:..');
	}
?>