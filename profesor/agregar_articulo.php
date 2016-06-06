<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor'))
	{
		if (isset($_POST) && !empty($_POST))
		{
			$titulo = $_POST['titulo'];
			$descripcion = $_POST['descripcion'];
			$articulo = $_POST['articulo'];
			$imagen = $_POST['imagen'];
			$web->subirImagen($_FILES);
			$web->nuevoArticulo($titulo,$articulo,$descripcion,$imagen);
			$web->mensaje("Articulo guardado",2);
		}
		$web->desplegar('profesor/agregar_articulo.html');
	}else{
		header('Location:..');
	}
?>