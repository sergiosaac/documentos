<?php


try {

  $bulk = new MongoDB\Driver\BulkWrite;

  $bulk->delete(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

  $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  $result = $manager->executeBulkWrite('documentacion.documentaciones', $bulk, $writeConcern);

  header('Location: ../index.php?nuevo='.$nuevo['nombre']);


} catch (MongoDB\Driver\Exception\Exception $e) {

    echo "<h1> Error </h1>";

    return "Error";
}
