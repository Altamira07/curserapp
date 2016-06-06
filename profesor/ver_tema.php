<?php
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$id = $_GET['id'];
		$tema = $_GET['tema'];
		$tema = $web->getTema($id,$tema);
		$temas = $web->getTemas($id);
		$web->asignar('id',$id);
		$web->asignar('temas',$temas);
		$web->asignar('tema',$tema);
		$web->desplegar('profesor/ver_tema.html');
	}else{
		header('Location:..');
	}
?>