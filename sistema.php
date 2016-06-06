<?php 
	include 'plantilla.php';
	include (PATHLIB.'phpmailer/PHPMailerAutoload.php');
	include(PATHLIB.'nusoap/nusoap.php');
	class Sistema extends Plantilla{
		function __construct(){
			parent::Iniciar();
			$this->clima();
		}
		public function cerrarSesion(){
			session_start();
			unset($_SESSION);
			session_destroy();
			header('Location: .');
		}
		public function clima()
		{
			$paramers = array('CityName'=>'Mexico', 'CountryName'=>'Mexico');
			try {
				$c = new nusoap_client('http://www.webservicex.net/globalweather.asmx?WSDL','wsdl');
				$result = $c->call('GetWeather',$paramers);
				$result = $result['GetWeatherResult'];
				$result = str_replace('utf-16', 'utf-8', $result);
				$temp = new SimpleXMLElement($result);
				$temperatura = $temp->Temperature;
			} catch (Exception $ex) {
				$temperatura = "";
			}
			$this->asignar('temp',$temperatura);
		}
		public function login($correo,$pass){
			if ($this->valCorreo($correo)){
				$pass = md5($pass);
				$datos = $this->datos("select * from usuario where correo = '$correo' && password = '$pass'");
				if (empty($datos)) {
					$datos = $this->datos("select * from usuario where correo = '$correo' && clave = '$pass'");
				}
				if (!empty($datos[0])){
					session_start();
					$_SESSION['correo'] = $correo;
					$_SESSION['logueado'] = true;
					$rol = $this->datos("select rol from vista_rolUsuario where correo = '$correo'");
					$rol = $rol[0]['rol'];
					$privilegios = $this->datos("select privilegio from vista_rolPrivilegio where rol = '$rol'");
					$_SESSION['rol'] = $rol;
					$_SESSION['privilegios'] = $privilegios;
					$gravatar = $this->datos("select vinculado from perfil where correo = '$correo' ");
					$_SESSION['gravatar'] = $gravatar[0][0];
					$_SESSION['img'] = $this->getGravatar();
					$clave = $this->getClave($correo);
					if ($rol === "alumno"){
						if (empty($clave)) {
							header('Location:alumno');
						}else{
							header('Location:alumno/restablecer.php');
						}
					}else if ($rol ==="profesor"){
						if (empty($clave)) {
							header('Location:profesor');
						}else{
							header('Location:profesor/restablecer.php');
						}
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
	    public function recuperar($correo){
	    	$clave = $this->geneClave();
	    	if ($this->existUsuario($correo)){
	    		$mensaje = "Hola estimado usuario de ferreweb con esta clave va a poder ingresar al sistema $clave" ;
	    		$this->enviCorreo ($correo,"Usuario","Recuperacion de contraseña",$mensaje);
    			$clave = md5 ($clave);
    			$this->saveClave($correo,$clave);
	    	}else{
	    		$this->mensaje("El usuario no existe",1);
	    	}
	    }
	    public function geneClave(){
	    	$clave = md5(rand(1,1000000));;
			return substr($clave,0,7);
	    }
	    public function enviCorreo ($destino,$nombre,$asunto,$mensaje)
		{
			$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
			$mail->IsSMTP(); // telling the class to use SMTP
			try {
			//$mail->SMTPDebug  = MAIL_SMTPDEBUG;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = MAIL_SMTPAUTH;                  // enable SMTP authentication
				$mail->SMTPSecure = MAIL_SMTPSECURE;                 // sets the prefix to the servier
				$mail->Host       = MAIL_HOST;      // sets GMAIL as the SMTP server
				$mail->Port       = MAIL_PORT;                   // set the SMTP port for the GMAIL server
				$mail->Username   = MAIL_USERNAME;  // GMAIL username
				$mail->Password   = MAIL_PASS;            // GMAIL password
				//Por si lo ocupo $mail->AddReplyTo('name@yourdomain.com', 'First Last');
				$mail->AddAddress($destino, $nombre);
				$mail->SetFrom(MAIL_USERNAME, 'Curserapp');
				$mail->Subject = $asunto;
				$mail->AltBody = $mensaje; // optional - MsgHTML will create an alternate automatically
				$mail->MsgHTML($mensaje);
				// Por si algun dia lo ocupo$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
				$mail->Send();
			} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
			}
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
	    			$this->query("insert into perfil(nick,correo) values('$correo','$correo')");
	    		}
	    	}
	    	return true;
	    }
	    public function subirImagen($imagen)
	    {
	    	if($imagen['imagen']['error']!=0){
				die("Error al subir la imagen");
			}
			if ($imagen['imagen']['size']> 204800) {
				die("Archivo demasiado grande");
			}
			$extenciones = array("image/jpeg","image/png");
			if (!in_array($_FILES['imagen']['type'], $extenciones)) {
				die("Archivo incompatible");
			}
			$foto = $imagen ['imagen']['name'];
			$origen = $imagen ['imagen']['tmp_name'];
			$destino = PATHAPP.'images/articulos/'.$foto;
			//$fotooriginal = $foto;
			if (!move_uploaded_file($origen, $destino)){
				die("Fallo al enviar el archivo");
			}
	    }

	}
	$web = new Sistema;
?>