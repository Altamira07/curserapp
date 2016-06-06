<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		$cursos = $web->getMisCursosTomados();
		$web->asignar('cursos',$cursos);
		$web->desplegar('alumno/mis_cursos.html');
	}else{
		header('Location:..');
	}
?>