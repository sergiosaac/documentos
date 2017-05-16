<?php

if ($_POST && !empty($_POST['nombre'])) {

	$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$bulk = new MongoDB\Driver\BulkWrite;

	$actualizando = array();

	$actualizando['nombre'] = $_POST['nombre'];

	$actualizando['urls'] = array();

	for ($i=0; $i < count($_POST['descripcion_url']); $i++) {

		$url = new stdClass();

		$url->nombre_url = $_POST['nombre_url'][$i];
		$url->descripcion_url = $_POST['descripcion_url'][$i];
		$url->method = $_POST['method'][$i];
		$url->entrada = $_POST['entrada'][$i];
		$url->url = $_POST['url'][$i];
		$url->salida = $_POST['salida'][$i];

		array_push($actualizando['urls'], $url);
	}

	$bulk->update(['_id' => new MongoDB\BSON\ObjectID($_POST['_id'])], $actualizando, ['multi' => false, 'upsert' => false]);

	$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
	$result = $mongo->executeBulkWrite('documentacion.documentaciones', $bulk, $writeConcern);

	header('Location: ../index.php?id='.$_POST['_id'].'&actualizado=1');

} else {
	echo "Completa todo el formulario!";
}
