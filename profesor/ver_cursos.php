<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$cursos = $web->getCursos();
		$web->asignar('cursos',$cursos);
		$web->desplegar('profesor/ver_cursos.html');
	}else{
		header('Location:..');
	}
?>