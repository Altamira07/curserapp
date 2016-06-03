<?php 
	include 'plantilla.php';
	class Sistema extends Plantilla{
		function __construct(){
			parent::Iniciar();
		}
		public function cerrarSesion(){
			session_start();
			unset($_SESSION);
			session_destroy();
			header('Location: .');
		}
		public function login($correo,$pass){
			if ($this->valCorreo($correo)){
				$pass = md5($pass);
				$datos = $this->datos("select * from usuario where correo = '$correo' && password = '$pass'");
				if (!empty($datos[0])){
					session_start();
					$_SESSION['correo'] = $correo;
					$_SESSION['logueado'] = true;
					$rol = $this->datos("select rol from vista_rolUsuario where correo = '$correo'");
					$rol = $rol[0]['rol'];
					$privilegios = $this->datos("select privilegio from vista_rolPrivilegio where rol = '$rol'");
					$_SESSION['rol'] = $rol;
					$_SESSION['privilegios'] = $privilegios;
					
					if ($rol === "admin") {
						header('Location:admin');
					}else if ($rol === "alumno"){
						header('Location:alumno');
					}else if ($rol ==="profesor"){
						header('Location:profesor');
					}
				}else{
					$this->mensaje("Usuario o contraseña incorrecta",1);
					$this->desplegar('iniciar_sesion.html');
				}
			}else{
				$this->mensaje("El correo no es valido",1);
				$this->desplegar('iniciar_sesion.html');
			}
		}
		public function rolVerificar($rol){
	    	if ($_SESSION['logueado'] && $_SESSION['rol'] === $rol ){
				
				return true;
	    	}
	    	return false;
	    }
		public function privVerificar($privilegio){
	        session_start();
	        if ($_SESSION['logueado']){
	            if(!in_array($privilege, $_SESSION['privilegios']))
	        		return false;
	        }
	        else
	    		return false;
	    	return true;
	    }
	    public function valCorreo($correo){
	    	if (!filter_var($correo, FILTER_VALIDATE_EMAIL) === false){
	            return true;
	        }
	        return false;
	    }
	    public function nuevCuenta($correo,$pass,$passR,$tipo)
	    {
	    	$pass = md5($pass);
	    	$passR = md5($passR);
	    	if ($this->valCorreo($correo))
	    	{
	    		if ($passR===$pass) 
	    		{
	    			$this->query("insert into usuario(correo,password,id_rol) values ('$correo','$pass','$tipo')");
	    		}
	    	}
	    	return true;
	    }

	}
	$web = new Sistema;
?>