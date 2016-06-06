<?php 
	include 'conexion.php';
	include (PATHLIB.'smarty/Smarty.class.php');
	include(PATHLIB.'html2pdf/vendor/autoload.php');
	class Plantilla extends Conexion{
		public $smarty;
		public function Iniciar(){
			$this->smarty = new Smarty;
			parent::Conectar();
			$this->smarty();
		}
		public function smarty ()
		{
			$this->smarty->setTemplateDir(PATHAPP.TEMPLATES);
			$this->smarty->setCompileDir(PATHAPP.TEMPLATES_C);
			$this->smarty->setCacheDir(PATHAPP.CACHE);
			$this->smarty->setConfigDir(PATHAPP.CONFIGS);
			$this->smarty->debugging = false;
			$this->smarty->caching = true;
			$this->smarty->cache_lifetime=0;

		}
		function getGravatar($s = 25, $d = 'mm', $r = 'g', $img = true, $atts = array() ) {
    		$email = $_SESSION['correo'];
    		$url = 'https://www.gravatar.com/avatar/';
    		$url .= md5( strtolower( trim( $email ) ) );
    			$url .= "?s=$s&d=$d&r=$r";
   	 			if ( $img ) {
        			$url = '<img src="' . $url . '"';
		        	foreach ( $atts as $key => $val )
		            $url .= ' ' . $key . '="' . $val . '"';
		        	$url .= ' />';
    			}
    		return $url;
		}
		public function pdfTemario($id){
			$html2pdf = new HTML2PDF('P','A4','fr');
			$html2pdf->setDefaultFont('Arial');
		    $datos = $this->datos("select * from curso c inner join tema t on t.id_curso = c.id_curso");
		    $this->asignar('datos',$datos);
		    $contenido = $this->smarty->fetch('temario.html');
		    $html2pdf->WriteHTML($contenido);
			$html2pdf->Output('temario.pdf');	
		}
		public function desplegar($vista){//Despliega la vista
			$this->smarty->display($vista);
		}
		public function asignar($nombre,$valor){//Asigana valores a la vista
			$this->smarty->assign($nombre,$valor);
		}
		public function error($mensaje){
			$this->mensaje($mensaje,1);
			$this->desplegar('error.html');
		}
		public function combo($query,$nombCombo){//Resibe el nombre del combo y la query donde sacara los datos
			$campCombo = $this->DB->GetAll($query);
			$this->asignar('nombCombo',$nombCombo);
			$this->asignar('campCombo',$campCombo);
			return $this->smarty->fetch('combo.html');
		}
		public function comentario($contComentario){
			$this->asignar('contComentario',$contComentario);
			return $this->smarty->fetch('comentario.html');
		}
		public function articulo($controlador){

		}
		public function tema($controlador){

		}
		public function mensaje($mensaje,$tipo){//Resibe dos parametros, el mensaje y tipo = 1 -> Error, tipo = 2 -> Aceptado
			$this->asignar('mensaje',$mensaje);
			$this->asignar('tipo',$tipo);
		}
	}
 ?>