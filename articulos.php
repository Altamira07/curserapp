<?php 
	include 'sistema.php';
	if (isset($_GET['q']) && !empty($_GET['q'])) {
		$articulos = $web->getArticuloLike($_GET['q']);
		if (empty($articulos)){
			$web->mensaje("No se encotraron coincidencias",1);
		}
	}else{
		$articulos = $web->getArticulos();
	}
	$web->asignar('articulos',$articulos);
	$web->desplegar('articulos.html');

?>