<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno') )
	{
		$cursos = $web->getCursos();
		$web->asignar('cursos',$cursos);
		$web->desplegar('alumno/cursos.html');

	}else{
		header('Location:..');
	}
?>