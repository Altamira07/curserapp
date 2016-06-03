<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		if (isset($_REQUEST) && !empty($_REQUEST)) 
		{
			$web->artiGuardar($_POST['titulo'],$_POST['articulo'],trim($_POST['imagen']));
			$web->mensaje("Guardado con exito",2);
		}

		$web->desplegar('profesor/agregar_articulo.html');
	}else{
		header('Location:..');
	}
 ?>