<?php
function checkAdmin($login, $pdo): bool {
	$query = $pdo->query("SELECT isAdmin FROM users where username = '$login'"); 
	$user = $query->fetch(PDO::FETCH_ASSOC);
	if($user['isAdmin'] == 0) return false;
	return true;
}

function getUser($login, $pdo){
    $query = $pdo->query("SELECT * FROM users where username = '$login'");
    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function addArticle($article, $pdo){
    $name= $article['name'];
    $quantity = $article['quantity'];
    $price = $article['price'];
    $query = $pdo->query("INSERT INTO products (name, quantity, price) VALUES ('$name', '$quantity', '$price')");
    return $query;
}

function getAllProducts($pdo){
    $articles = $pdo->query("SELECT * FROM products");
    return $articles;
}

function checkOrderExist($login, $pdo){
    $user = getUser($login, $pdo);
    $checkOrderQuery = $pdo->query("SELECT * FROM orders where userId='$user[id]' and isClosed=1"); 
    $response = $checkOrderQuery->fetch(PDO::FETCH_ASSOC);
    if(!$response){
        $sql = "INSERT INTO orders (userId, orderDate, isClosed) VALUES (?,?,?)";
        $query= $pdo->prepare($sql)->execute([$user['id'], ])
    }
}