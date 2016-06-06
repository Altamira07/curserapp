<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				$web->upCurso($_POST['id'],$_POST['curso'],$_POST['descripcion']);
			}else{
				$web->temaNuevo($_GET['id'],$_POST['tema'],$_POST['descripcion'],$_POST['video']);
			}
			$web->mensaje("Guardado",2);
		}
		if (isset($_GET['del']) && !empty($_GET['del'])) {
			$web->delTema($_GET['id'],$_GET['del']);
			$web->mensaje("Tema borrado",2);
		}
		$curso = $web->getMiCurso($_GET['id']);
		$temas = $web->getTemas($_GET['id']);
		$web->asignar('temas',$temas);
		$web->asignar('curso',$curso);
		$web->desplegar('profesor/editar_curso.html');
	}else{
		header('Location:..');
	}
?>
