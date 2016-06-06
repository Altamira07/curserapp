<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		if (isset($_POST) && !empty($_POST)) 
		{
			$passN = md5($_POST['passN']);
			$passR = md5($_POST['passR']);
			$passA = md5($_POST['passA']);
			if ($passA === $web->getPassA()){
				if ($passR === $passN) {
					$web->cambPass($passN);
					$web->mensaje("Contrasena combiada",2);
				}else{
					$web->mensaje("Las contraseñas deben coincidir",1);
				}
			}else{
				$web->mensaje("La contraseña actual no es valida",1);
			}
		}
		$web->desplegar('alumno/cambiar_pass.html');
	}else{
		header('Location:..');
	}
?>