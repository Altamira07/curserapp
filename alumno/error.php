<?php
	include '../sistema.php'; 
	session_start();
	if ($_SESSION['logueado'] && $web->rolVerificar('alumno') )
	{
		$web->desplegar('alumno/error.html');
	}else{
		header('Location:..');
	}
 ?>