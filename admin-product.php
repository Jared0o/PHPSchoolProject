<?php
include_once('database/database.php');
include_once('database/databasefunctions.php');

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['id'];
$method = $data['method'];
if($method == 'active' ){
    activeArtice($productId, $pdo);
    echo json_encode(["id"=>"$productId", "message"=>"Produkt z id: '$productId' został aktywowany"]);
}
if($method == 'delete'){
    deactiveProduct($productId, $pdo);
    echo json_encode(["id"=>"$productId", "message"=>"Produkt z id: '$productId' został zablokowany"]);
}


