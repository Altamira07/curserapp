<?php 
	include 'sistema.php';
	$bandera = false;
	if (isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['pass']) && !empty($_POST['pass']) && isset($_POST['passR']) && !empty($_POST['passR']) && isset($_POST['opcion']) && !empty($_POST['opcion']) && md5($_POST['pass']) === md5($_POST['passR']) )
	{
			if ($web->nuevCuenta($_POST['correo'], $_POST['pass'],$_POST['passR'],$_POST['opcion'])) 
			{
				$web->mensaje("Cuenta creada con exito",2);
			}else{
				$web->mensaje("No se pudo crear la cuenta",1);
			}
	}else{
		if (isset($_POST) && !empty($_POST)) 
		{
			if (empty($_POST['correo']) && empty($_POST['pass']))
			{
				$web->mensaje("Llena todos los campos",1);
			} else if (empty($_POST['correo'])) 
			{
				$web->mensaje("Falta el correo",1);
			}else if (empty($_POST['pass'])) 
			{
				$web->mensaje("Falta contraseña",1);
			}else if(empty($_POST['opcion']))
			{
				$web->mensaje("Falta tipo de cuenta",1);
			}else if (md5($_POST['pass']) != md5($_POST['passR']) )
			{
				$web->mensaje("Las contraseñas no coinciden",1);
			}
		}
	}
	$web->desplegar('nueva_cuenta.html');
	
?>