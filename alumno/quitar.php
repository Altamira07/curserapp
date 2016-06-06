<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		$web->quitarCurso($_GET['quitar']);
		header('Location:mis_cursos.php');
	}else{
		header('Location:..');
	}
?>