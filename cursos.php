<?php 
	include 'sistema.php';
	if (isset($_GET['q']) && !empty($_GET['q'])) {
		$cursos = $web->getCursoLike($_GET['q']);
		if (empty($cursos)) {
			$web->mensaje("No se encotraron coincidencias",1);
			//$cursos = $web->getCursos();
		}
	}else{
		$cursos = $web->getCursos();
	}
	$web->asignar('cursos',$cursos);
	$web->desplegar('cursos.html');
?>