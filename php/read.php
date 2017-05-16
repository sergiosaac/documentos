<?php

class MongoCrud
{
	private $mongo;

	function __construct()
	{
		$this->mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	}


	public function read()
	{
		try {

		    $query = new MongoDB\Driver\Query([]);

		    $rows = $this->mongo->executeQuery("documentacion.documentaciones", $query);

		    $documentacion = $rows->toArray();

		    $items = $this->mongo->executeQuery("documentacion.items", $query);

		    $items = json_encode($items->toArray()[0]->info_lista);

		} catch (MongoDB\Driver\Exception\Exception $e) {

		    $filename = basename(__FILE__);

		    echo "The $filename script has experienced an error.\n";
		    echo "It failed with the following exception:\n";

		    echo "Exception:", $e->getMessage(), "\n";
		    echo "In file:", $e->getFile(), "\n";
		    echo "On line:", $e->getLine(), "\n";
		}

		return ['documentacion' => $documentacion,'items' => $items];
	}

	public function create($nuevo = null, $contador = 0)
	{
	    $bulk = new MongoDB\Driver\BulkWrite;

	    $nuevo = ['nombre' => 'Recibidas', 'urls' => $contador++];

		$bulk->insert($nuevo);

		$this->mongo->executeBulkWrite('documentacion.documentaciones', $bulk);

		return;
	}

	public function obtenerUno($id = '')
	{


		try {

			$filter = ['_id' => new MongoDB\BSON\ObjectID($id)];

			$query = new MongoDB\Driver\Query($filter);

			$rows = $this->mongo->executeQuery('documentacion.documentaciones', $query);

			foreach ($rows as $document) {
					return $document;
			}

		} catch (MongoDB\Driver\Exception\Exception $e) {

		    echo "<h1> Error </h1>";

				return "Error";
		}
	}

	public function update($id = '')
	{
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

			array_push($nuevo['urls'], $url);
		}

		$bulk->update(['_id' => new MongoDB\BSON\ObjectID($id)], $actualizando, ['multi' => false, 'upsert' => false]);

		$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
		$result = $this->mongo->executeBulkWrite('documentacion.documentaciones', $bulk, $writeConcern);

	}
}

$obtenerDocs = new MongoCrud();

$documentacion = $obtenerDocs->read()['documentacion'];
$items = $obtenerDocs->read()['items'];
$selecionado = $obtenerDocs->obtenerUno('59161d10962d74219d099fe2');
$selecionadoActivo = '59161d10962d74219d099fe2';

if (isset($_GET['id'])) {
	$selecionado = $obtenerDocs->obtenerUno($_GET['id']);
	$selecionadoActivo = $_GET['id'];
}
