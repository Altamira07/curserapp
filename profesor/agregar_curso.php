<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		if (isset($_POST) && !empty($_POST)){
			$titulo = $_POST['titulo'];
			$descripcion = $_POST['descripcion'];
			$web->cursoNuevo($titulo,$descripcion);
		}
		
		$cursos = $web->getCursos();
		$web->asignar('cursos',$cursos);

		$web->desplegar('profesor/agregar_curso.html');
	}else{
		header('Location:..');
	}
?>