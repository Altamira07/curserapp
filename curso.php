<?php 
	include 'sistema.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$curso = $web->getCurso($_GET['id']);
		if (!empty($curso)) {
			$web->asignar('curso',$curso);
			$web->desplegar('curso.html');
		}else{
			header('Location:error.php');	
		}
	}else{
		header('Location:error.php');
	}
?>