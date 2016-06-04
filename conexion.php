<?php 
	include 'configuracion.php';
	include (PATHLIB.'adodb/adodb.inc.php');
	class Conexion{
		public $rs;
		function Conectar()
		{
			$this->server =DB_DBMS;
			$this->host =DB_HOST;
			$this->userdb=DB_USER;
			$this->passdb=DB_PASS;
			$this->database=DB_NAME;
			$this->DB=&ADONewConnection($this->server);
			$this->DB->pConnect($this->host,$this->userdb,$this->passdb,$this->database);
		}
		//Ejecuta una query en la base de datos
		public function query($query){
			$this->query = $query;
			$this->rs  = $this->DB->Execute($this->query);
			if ($this->DB->ErrorMsg())
				$this->error("Valio mae".$this->DB->ErrorMsg());

		}
		//Ejecuta una query y regresa los datos de esta
		public function datos($query){
			$datos = $this->DB->GetAll($query);
			return $datos;
		}
		public function artiGuardar($titulo,$contenido,$imagen=""){
			$correo = $_SESSION['correo'];
			$encoded = $imagen;
			$encoded = str_replace(' ', '+', $encoded);
			$encoded = str_replace('data:image/jpeg;base64,', '', $encoded);
			$image = base64_decode($encoded);
			//para mysql
			$image = mysql_escape_string($image);
			//par postgres
			//$image = pg_escape_bytea($image); y -> '{$image}' 
			$this->query("insert into articulo (titulo,contenido,correo,imagen) values('$titulo','$contenido','$correo','$image')");
		}
		public function getCursos(){
			$correo = $_SESSION['correo'];
			return $this->datos("select * from curso where correo = '$correo'");
		}
		public function getCurso($id){
			$correo = $_SESSION['correo'];
			return $this->datos("select * from curso where correo = '$correo' and id_curso=$id");
		}
		public function delTema($id_curso,$id_tema){
			$this->query("delete from tema where id_curso='$id_curso' and id_tema ='$id_tema'");
		}
		public function temaNuevo($id_curso,$tema,$descripcion,$link){
			$this->query("insert into tema (id_curso,tema,descripcion,video) values ('$id_curso','$tema','$descripcion','$link')");		
		}
		public function upTema($id_curso,$id_tema,$tema,$descripcion,$video){
			$this->query("update tema set tema='$tema',descripcion='$descripcion', video='$video' where id_tema='$id_tema' and id_curso ='$id_curso' ");
		}
		public function getTema($id_curso,$id_tema){
			return $this->datos("select id_tema,tema,descripcion,video from tema where id_curso='$id_curso' and id_tema='$id_tema'" );
		}
		public function getTemas($id_curso){
			return $this->datos("select id_tema,tema from tema where id_curso='$id_curso'");
		}
		public function cursoNuevo($nombre,$descripcion){
			$correo = $_SESSION['correo'];
			$clave = md5(rand(1,1000000));;
			$clave = substr($clave,0,7);
			$this->query ("insert into curso(curso,descripcion,correo,cveAcceso) values ('$nombre','$descripcion','$correo','$clave')");
		}
		public function upCurso($id_curso,$curso,$descripcion){
			$correo = $_SESSION['correo'];
			$this->query("update curso set curso='$curso', descripcion='$descripcion' where id_curso='$id_curso' and correo = '$correo'  ");
		}
		public function getArticulos($correo){
			return $this->datos("select id_articulo,titulo,descripcion,contenido,imagen from articulo where correo = '$correo'");
		}
		public function nuevoArticulo($titulo,$articulo,$descripcion,$imagen){
			$correo = $_SESSION['correo'];
			$this->query("insert into articulo(titulo,contenido,descripcion,imagen,correo) values ('$titulo','$articulo','$descripcion','$imagen','$correo')");
		}
		public function getMiArticulo ($id,$correo){
			return $this->datos("select * from articulo where id_articulo = $id and correo = '$correo'");
		}
		public function delMiArticulo($id,$correo){
			$this->query("delete from articulo where id_articulo = $id and correo = '$correo' ");
		}
		public function upMiArticulo($id,$titulo,$contenido,$descripcion){
			$correo = $_SESSION['correo'];
			$this->query("update articulo set titulo='$titulo', contenido='$contenido', descripcion='$descripcion' where id_articulo =$id and correo='$correo' ");
		}
	}

 ?>