<?php 
	include ('../../sistema.php');
	class CursosAPI extends Sistema
	{
		public function API()
		{
			$method = $_SERVER['REQUEST_METHOD'];
			header('Content-Type: application/json');
			switch ($method)
			{
				case 'GET':
					if (isset($_GET['id']))
					{
						$id = $_GET['id'];
						$response = $this->getCurso($id);
					}else{
						$response = $this->getCursos();
					}
					echo json_encode($response,JSON_PRETTY_PRINT);
					break;
				/*case 'POST':
					$this->newArticulo();
					break;
				case 'PUT':
					$this->updateArticulo();
					break;
				case 'DELETE':
					$this->deleteArticulo();
					break;
				default:*/ 
			}
		}
		/*public function newArticulo()
		{
			$obj = json_decode(file_get_contents('php://input'));
			$objArr = (array)$obj;
			$this->insert($obj->titulo);
			$this->response(200,"success","new record");
		}
		public function response ($code=200,$status="",$message="")
		{
			http_response_code($code);
			$response = array("status"=>$status,"message"=>$message);
			echo json_encode($response,JSON_PRETTY_PRINT);
		}
		public function insert ($titulo='')
		{
			$this->query("insert into articulo (titulo) values('$titulo')");
			return $this->rs;
		}
		public function updateArticulo()
		{
			$obj = json_decode(file_get_contents('php://input'));
			$objArr = (array)$obj;
			$id = $_GET['id'];
			$this->update($id,$obj->titulo);
			$this->response(200,"success","new record");
		}
		public function update($id,$titulo='')
		{
			$this->query("update articulo set titulo = '$titulo' where id_articulo = '$id' ");
			return $this->rs;
		}
		public function deleteArticulo()
		{
			$id = $_GET['id'];
			$this->delete($id);
			$this->response(200,"success","new record");
		}
		public function delete($id)
		{
			$this->query("delete from articulo where id_articulo = '$id' ");
			return $this->rs;
		}*/
	}
?>