<?php 
	include 'conexion.php';
	include (PATHLIB.'smarty/Smarty.class.php');
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