<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		$datos = $web->datos("select id_articulo,titulo,descripcion from articulo");
		$web->asignar('datos',$datos);
		$web->desplegar('profesor/ver_articulos.html');
	}else{
		header('Location:..');
	}	
?>