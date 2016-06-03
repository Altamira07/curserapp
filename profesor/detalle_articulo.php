<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$id = $_GET['id'];
		header("Content-type: image/png");
		$datos = $web->datos("select titulo,contenido,imagen from articulo where id_articulo = $id");
		$titulo = $datos[0]['titulo'];
		$contenido = $datos[0]['contenido'];
		$web->asignar('titulo',$titulo);
		$web->asignar('contenido',$contenido);
		echo $datos[0]['imagen'];
		$web->desplegar('profesor/detalle_articulo.html');
	}else{
		header('Location:..');
	}
?>