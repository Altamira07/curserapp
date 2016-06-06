<?php 
	include 'sistema.php';
	if (isset($_GET['id']) && !empty($_GET['id'])){
			$web->pdfTemario($_GET['id']);
	}

?>