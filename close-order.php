<?php
include_once('database/database.php');
include_once('database/databasefunctions.php');
include_once('functions/session.php');

$data = json_decode(file_get_contents('php://input'), true);

$orderId = $data['id'];

$order = closeOrder($orderId, $pdo);

echo json_encode(["id"=>"$orderId", "message"=>"Zamówienie zostało zrealizowane"]);


