<?php
$mysql_host = 'localhost'; 
$port = '3306'; 
$username = 'produkty';
$password = 'produkty';
$database = 'produkty'; //'produkty'

try{
	$pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database.';port='.$port, $username, $password );
	echo 'Połączenie nawiązane!';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo 'Połączenie nie mogło zostać utworzone.<br />';
}