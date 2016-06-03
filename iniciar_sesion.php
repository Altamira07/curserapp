<?php 
	include 'sistema.php';
	$bandera = false;
	if (isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];
		$bandera = true;
	}else{
		if (isset($_POST) && !empty($_POST)) {
			if (empty($_POST['correo']) && empty($_POST['pass'])){
				$web->mensaje("Llena todos los campos",1);
			} else if (empty($_POST['correo'])) {
				$web->mensaje("Falta el correo",1);
			}else if (empty($_POST['pass'])) {
				$web->mensaje("Falta contraseña",1);
			}
		}
		$web->desplegar('iniciar_sesion.html');
	}
	if ($bandera) {
		$web = new Sistema;
		$web->login($correo,$pass);
	}
?>