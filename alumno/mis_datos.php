<?php 
	include '../sistema.php';
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno')){
		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['vincular']) && !empty($_POST['vincular'])) {
				$vincular = 1;
				$_SESSION['gravatar'] = 1;
			}else{
				$vincular = 0;
				$_SESSION['gravatar'] = 0;
			}
			$web->upPerfil($_POST['nick'],$_POST['nombre'],$_POST['apaterno'],$_POST['amaterno'],$_POST['edad'],$vincular);
		}
		$perfil = $web->getPerfil();
		$web->asignar('perfil',$perfil);
		$web->desplegar('alumno/mis_datos.html');
	}else{
		header('Location:..');
	}
?>