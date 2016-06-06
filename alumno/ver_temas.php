<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		if (isset($_GET) && !empty($_GET)) {
			$temas = $web->getTemas($_GET['id']);
			$web->asignar('temas',$temas);
			$web->asignar('id',$_GET['id']);
			$web->desplegar('alumno/ver_temas.html');
		}else{
			header('Location:error.php');
		}
	}else{
		header('Location:..');
	}
?>