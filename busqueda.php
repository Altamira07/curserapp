<?php 
    include 'sistema.php';
    $q="";
    if (isset($_GET['q']) && !empty($_GET['q'])) 
        $q = $_GET['q'];
    $datos = $web->datos("select * from articulos where articulo like %$q% ");
    if(!empty($datos))
        $web->asignar('datos',$datos);
    else
        $web->mensaje("No se encontraron resultados",1);
    $web->desplegar('verArticulos.html');    
?>