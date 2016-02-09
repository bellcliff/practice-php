<?php
require __DIR__.'/../vendor/autoload.php';
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // connect

$page = isset($_GET['page']) ? intval($_GET['page']) : 10;
$per = isset($_GET['per']) ? intval($_GET['per']) : 10;
$qOpts = array(
    'limit' => $per,
    'skip' => $per * ($page - 1)
);
$query = new MongoDB\Driver\Query(array(), $qOpts);  // equal find({})
$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
$cursor = $manager->executeQuery("test.interview", $query, $readPreference);
header('Content-Type: application/json');

// query count
$q1 = new MongoDB\Driver\Query(array());
$c1 = $manager->executeQuery("test.interview", $q1, $readPerference);

// return result with count
echo json_encode(array(
    'items' => $cursor->toArray(),
    'count' => count($c1->toArray())
));
?>
