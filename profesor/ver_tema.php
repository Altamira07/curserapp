<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$tema = $web->getTema($_GET['ecurso'],$_GET['verTema']);
		$titulo = $tema[0][1];
		$descripcion = $tema[0][2];
		$video = $tema[0][3];
		$id = $tema[0][0];
		$temas = $web->getTemas($_GET['ecurso']);
		$web->asignar('id',$_GET['verTema']);
		$web->asignar('titulo',$titulo);
		$web->asignar('descripcion',$descripcion);
		$web->asignar('video',$video);
		$web->asignar('temario',$temas);
		$web->asignar('curso',$_GET['ecurso']);
		$web->desplegar('profesor/ver_tema.html');
	}else{
		header('Location:..');
	}
?>