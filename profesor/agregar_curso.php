<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor') ){
		if (isset($_POST) &&  !empty($_POST)) {
			$web->cursoNuevo($_POST['curso'],$_POST['descripcion'],$_POST['imagen']);
			$web->subirImagen($_FILES);
			$web->mensaje("Curso guardado",2);
		}
		$cursos = $web->getMisCursos();
		$web->asignar('cursos',$cursos);
		$web->desplegar('profesor/agregar_curso.html');
	}else{
		header('Location:..');
	}
?>