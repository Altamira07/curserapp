<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$id_curso = $_GET['ecurso'];
		if (isset($_POST['b']) && !empty($_POST['b'])){
			$web->mensaje("Informacion actualizada",2);
			$web->upCurso($id_curso,$_POST['b']['titulo'],$_POST['b']['descripcion']);
		}
		if (isset($_POST['tn']) && !empty($_POST['tn'])) {
			$web->mensaje("Se agrego un nuevo tema",2);
			$web->temaNuevo($id_curso,$_POST['tn']['tema'],$_POST['tn']['descripcion'],$_POST['tn']['link']);
		}
		if (isset($_GET['delTema']) && !empty($_GET['delTema'])) {
			$web->mensaje("Se elimo un tema",2);
			$web->delTema($id_curso,$_GET['delTema']);
		}
		if (isset($_GET['edtTema']) && !empty($_GET['edtTema'])) {
			$tema = $web->getTema($id_curso,$_GET['edtTema']);
			$web->asignar('tema',$tema);
		}
		if (isset($_POST['tu']) && !empty($_POST['tu'])){
			print_r($_POST);
			$web->upTema($id_curso,$_POST['id_tema'],$_POST['tu']['tema'],$_POST['tu']['descripcion'],$_POST['tu']['link']);
		}
		$temas = $web->getTemas($id_curso);
		$curso = $web->getCurso($id_curso);
		$web->asignar('temas',$temas);
		$web->asignar('titulo',$curso[0]['curso']);
		$web->asignar('descripcion',$curso[0]['descripcion']);
		$web->asignar('id',$_GET['ecurso']);
		$web->desplegar('profesor/editar_curso.html');
	}else{
		header('Location:..');
	}
 ?>