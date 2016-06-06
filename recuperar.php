<?php 
	include 'sistema.php';
	if (isset($_POST['correo']) && !empty($_POST['correo'])){
		$web->recuperar($_POST['correo']);
	}
	$web->desplegar('recuperar.html');
 ?>