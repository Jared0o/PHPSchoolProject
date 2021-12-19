<?php
include_once('database/database.php');
include_once('database/databasefunctions.php');
include_once('functions/session.php');

$data = json_decode(file_get_contents('php://input'), true);

$productId = $data['id'];

$order= addProductToOrder($loginSession, $productId, $pdo);

echo json_encode(["id"=>"$productId", "message"=>"Produkt z id: '$productId' został dodany do twojego zamówienia"]);



