<?php 	
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor') )
	{
		$id = $_GET['id'];
		$articulo = $web->getMiArticulo($id,$_SESSION['correo']);
		if (!empty($articulo)) {
			$titulo = $articulo[0]['titulo'];
			$contenido = $articulo[0]['contenido'];
			$imagen = $articulo[0]['imagen'];
			$id = $articulo[0]['id_articulo'];
			$web->asignar('titulo',$titulo);
			$web->asignar('contenido',$contenido);
			$web->asignar('imagen',$imagen);
			$web->asignar('id',$id);
			$web->desplegar('profesor/mi_articulo.html');
		}else{
			header('Location:error.php');
		}
	}else{
		header('Location:..');
	}
 ?>