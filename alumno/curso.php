<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['tomar']) && !empty($_POST['tomar'])) {
				$web->tomarCurso($_POST['tomar']);
			}else if (isset($_POST['quitar']) && !empty($_POST['quitar'])) {
				$web->quitarCurso($_POST['quitar']);
			}
		}
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$curso = $web->getCurso($_GET['id']);
			if (!empty($curso)) {
				$toma = $web->getTomando($_GET['id']);
				if (!empty($toma)) {
					$web->asignar('toma',1);
				}else{
					$web->asignar('toma',0);
				}
				$web->asignar('curso',$curso);
				$web->desplegar('alumno/curso.html');
			}else{

				header('Location:error.php');	
			}
		}else{
			die();
			header('Location:error.php');
		}
	}else{
		header('Location:..');
	}
?>