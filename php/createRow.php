<?php 

if ($_POST && !empty($_POST['nombre'])) {

	$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$bulk = new MongoDB\Driver\BulkWrite;

	$nuevo = array();

	$nuevo['nombre'] = $_POST['nombre'];
	$nuevo['urls'] = array();

	for ($i=0; $i < count($_POST['descripcion_url']); $i++) { 
		
		$url = new stdClass();
		
		$url->nombre_url = $_POST['nombre_url'][$i];
		$url->descripcion_url = $_POST['descripcion_url'][$i];
		$url->method = $_POST['method'][$i];
		$url->entrada = $_POST['entrada'][$i];
		$url->url = $_POST['url'][$i];
		$url->salida = $_POST['salida'][$i];
		
		array_push($nuevo['urls'], $url);
	}

	$bulk->insert($nuevo);

	$mongo->executeBulkWrite('documentacion.documentaciones', $bulk);

	header('Location: ../index.php?nuevo='.$nuevo['nombre']);

} else {
	echo "Completa todo el formulario!";
}


