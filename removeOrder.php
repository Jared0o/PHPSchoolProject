<?php
include_once('database/database.php');
include_once('database/databasefunctions.php');
include_once('functions/session.php');

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['id'];
$method = $data['method'];
if($method == 'removeFromOrder' ){

    $res = removeProductFromOrder($loginSession, $productId, $pdo );
    if($res != null){
        echo json_encode(["id"=>"$productId", "message"=>"Produkt z id: '$productId' został usunięty z twojego zamowienia"]);
    }else {
        echo json_encode(["id"=>"$productId", "message"=>"Ups coś poszło nie tak"]);
    }
    
}



