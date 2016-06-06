<?php 
	include 'sistema.php';
	$id = $_GET['id'];
	$articulo = $web->getArticulo($id);
	if (!empty($articulo)) {
		$titulo = $articulo[0]['titulo'];
		$contenido = $articulo[0]['contenido'];
		$imagen = $articulo[0]['imagen'];
		$id = $articulo[0]['id_articulo'];
		$web->asignar('titulo',$titulo);
		$web->asignar('contenido',$contenido);
		$web->asignar('imagen',$imagen);
		$web->asignar('id',$id);
		$web->desplegar('articulo.html');
	}else{
		header('Location:error.php');
	}
	
?>