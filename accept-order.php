<?php
include_once('database/database.php');
include_once('database/databasefunctions.php');
include_once('functions/session.php');

$data = json_decode(file_get_contents('php://input'), true);

$productId = $data['id'];

$order= acceptOrder($loginSession, $pdo);

echo json_encode(["id"=>"$productId", "message"=>"Zamówienie zostało zamknięte i przekazane do realizacji"]);


