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
		public function tomarCurso($id){
			$correo =$_SESSION['correo'];
			$this->query("insert into tomando(id_curso,correo) values('$id','$correo')");
		}
		public function quitarCurso($id){
			$correo =$_SESSION['correo'];
			$this->query("delete from tomando where id_curso='$id' and correo = '$correo' ");	
		}
		public function getMisCursosTomados(){
			$correo =$_SESSION['correo'];
			return $this->datos("select c.id_curso,c.curso from tomando t inner join curso c on c.id_curso = t.id_curso   where t.correo = '$correo' ");
		}
		public function getTomando($id){
			$correo =$_SESSION['correo'];
			return $this->datos("select * from tomando where id_curso = '$id' and correo ='$correo'");	
		}
		public function getPassA(){
			$correo = $_SESSION['correo'];
			$dat = $this->datos("select password from usuario where correo = '$correo'");
			return $dat[0][0];
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
		public function getPerfil(){
			$correo = $_SESSION['correo'];
			return $this->datos("select * from perfil where correo = '$correo'");
		}
		public function upPerfil($nick,$nombre,$apaterno,$amaterno,$edad,$vinculado){
			$correo = $_SESSION['correo'];
			$this->query("update perfil set nick='$nick',nombre= '$nombre',apaterno='$apaterno',amaterno='$amaterno',edad='$edad',vinculado='$vinculado' where correo = '$correo' ");
		}
		public function getCursos(){
			return $this->datos("select * from curso");
		}
		public function getMisCursos(){
			$correo = $_SESSION['correo'];
			return $this->datos("select * from curso where correo = '$correo'");
		}
		public function getCurso($id){
			return $this->datos("select * from curso where id_curso='$id'");
		}
		public function upMiCurso($id,$curso,$descripcion){
			$correo = $_SESSION['correo'];
			$this->query("update curso set curso = $curso, descripcion = $descripcion where id_curso = $id and correo = $correo ");
		}
		public function getMiCurso($id){
			$correo = $_SESSION['correo'];
			return $this->datos("select * from curso where correo = '$correo' and id_curso=$id");
		}
		public function delMiCurso($id){
			$correo = $_SESSION['correo'];
			$this->query("delete from tema where id_curso ='$id' ");
			$this->query("delete from curso where id_curso = '$id' ");
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
		public function cursoNuevo($nombre,$descripcion,$imagen){
			$correo = $_SESSION['correo'];
			$clave = md5(rand(1,1000000));;
			$clave = substr($clave,0,7);
			$this->query ("insert into curso(curso,descripcion,correo,cveAcceso,imagen) values ('$nombre','$descripcion','$correo','$clave','$imagen')");
		}
		public function upCurso($id_curso,$curso,$descripcion){
			$correo = $_SESSION['correo'];
			$this->query("update curso set curso='$curso', descripcion='$descripcion' where id_curso='$id_curso' and correo = '$correo'  ");
		}
		public function getMisArticulos($correo){
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
		public function getArticulos(){
			return $this->datos("select id_articulo,titulo,descripcion,contenido,imagen from articulo");
		}
		public function getArticulo($id){
			return $this->datos("select id_articulo,titulo,descripcion,contenido,imagen from articulo where id_articulo = $id ");
		}
		public function cambPass($pass){
			$correo = $_SESSION['correo'];
			//$pass = md5($pass);
			$this->query("update usuario set password = '$pass' where correo = '$correo' "); 
		}
		public function existUsuario($correo){
			$dat = $this->datos("select * from usuario where correo = '$correo' ");
			if (!empty($dat)) {
				return true;
			}
			return false;
		}
		public function saveClave($correo,$clave){
			$this->query("update usuario set clave = '$clave' where correo='$correo'");
		}
		public function getClave($correo){
			$dat = $this->datos("select clave from usuario where correo = '$correo' ");
			return $dat[0][0];
		}
		public function actPass($pass){
			$correo = $_SESSION['correo'];
			$this->query("update usuario set clave = '', password = '$pass' where correo = '$correo'");
		}
		public function getCursoLike($q){
			return $this->datos("select * from curso where curso like '%$q%'");
		}
		public function getArticuloLike($q){
			return $this->datos("select id_articulo,titulo,descripcion,contenido,imagen from articulo where titulo like '%$q%' ");
		}
	}

 ?>