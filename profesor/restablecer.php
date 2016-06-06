<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('profesor')){
		if (isset($_POST) && !empty($_POST)){
			$passN = md5($_POST['passN']);
			$passR = md5($_POST['passR']);
			if ($passN === $passR) {
				$web->actPass($passN);
				$web->mensaje("Se reestablecio contraseña",2);
			}else{
				$web->mensaje("Las contraseñas no son iguales",1);
			}
		}
		$web->desplegar('profesor/restablecer.html');
	}else{
		header('Location:..');
	}
?>