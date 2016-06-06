<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor') )
	{
		$id = $_GET['id'];
		if (isset($_POST) && !empty($_POST)){
			$id = $_POST['id'];
			$titulo = $_POST['titulo'];
			$contenido = $_POST['articulo'];
			$descripcion = $_POST['descripcion'];
			$web->upMiArticulo($id,$titulo,$contenido,$descripcion);
			$web->mensaje("Guardado con exito",2);
		}
		$articulo = $web->getMiArticulo($id,$_SESSION['correo']);
		if (!empty($articulo)) {
			$id =$articulo[0]['id_articulo'];
			$titulo = $articulo[0]['titulo'];
			$contenido = $articulo[0]['contenido'];
			$descripcion = $articulo[0]['descripcion'];
			$imagen = $articulo[0]['imagen'];
			$web->asignar('id',$id);
			$web->asignar('titulo',$titulo);
			$web->asignar('contenido',$contenido);
			$web->asignar('descripcion',$descripcion);
			$web->asignar('imagen',$imagen);
			$web->desplegar('profesor/editar_articulo.html');
		}else{
			header('Location:mis_articulos.php');
		}

	}else{
		header('Location:..');
	}
?>