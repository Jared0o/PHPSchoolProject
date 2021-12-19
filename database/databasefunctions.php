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

function getUserId($login, $pdo){
    $query = $pdo->query("SELECT * FROM users where username = '$login'");
    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user['id'];
}

function addArticle($article, $pdo){
    $name= $article['name'];
    $img = $article['img'];
    $price = $article['price'];
    $query = $pdo->query("INSERT INTO products (name, price, img) VALUES ('$name', '$price', '$img')");
    return $query;
}

function getAllProducts($pdo){
    $articles = $pdo->query("SELECT * FROM products");
    return $articles;
}
function getAllActiveProducts($pdo){
    $articles = $pdo->query("SELECT * FROM products where isActive=1");
    return $articles;
}

function checkOrderExist($login, $pdo){
    $user = getUser($login, $pdo);
    $checkOrderQuery = $pdo->query("SELECT * FROM orders where userId='$user[id]' and isAccepted=0"); 
    $response = $checkOrderQuery->fetch(PDO::FETCH_ASSOC);
     if(!$response){
         $date = date('Y-m-d H:i:s');
         $sql = "INSERT INTO orders (userId, orderDate) VALUES (?,?)";
         $pdo->prepare($sql)->execute([$user['id'],$date ]);
     }
}

function deactiveProduct($id, $pdo) {
    $productQuery = $pdo->query("UPDATE products SET isActive=0 where id='$id';");
}

function activeArtice($id, $pdo) {
    $productQuery = $pdo->query("UPDATE products SET isActive=1 where id='$id';");
}

function getOrderNumber($login, $pdo){
    // $query = $pdo->query("SELECT 'orders.id' from orders INNER JOIN users on 'orders.userId'='users.id' where 'users.username'='$login' and 'orders.isAccepted'=0;");
    $query = $pdo->query("SELECT orders.id from orders INNER JOIN users on users.id = orders.userId where users.username = '$login' and orders.isAccepted = 0;");
    $orderNumber = $query->fetch(PDO::FETCH_ASSOC);
    return $orderNumber;
}

function getActualOrder($login, $pdo) {
    $orderNumber = getOrderNumber($login, $pdo)['id'];
    $order = $pdo->query("select orderproduct.id as opId, products.name, products.price, products.id from orders INNER JOIN orderproduct on orderproduct.orderId = orders.id INNER JOIN products on orderproduct.ProductId = products.id WHERE orders.id = '$orderNumber';");
    return $order;
}

function addProductToOrder($login, $productId, $pdo){
    $actualOrder = getOrderNumber($login, $pdo)['id'];
    $query = $pdo->query("INSERT INTO orderproduct (orderId, productId, date) VALUES ('$actualOrder', $productId, now());");
    return $query;
}

function removeProductFromOrder($login, $orderProductId, $pdo) {
    $queryUser = $pdo->query("select users.username from orders INNER JOIN orderproduct on orderproduct.orderId = orders.id INNER JOIN users on users.id = orders.userId WHERE orderproduct.id='$orderProductId';");
    $queryUser = $queryUser->fetch(PDO::FETCH_ASSOC);
    $data = ['id' => $orderProductId];

    if($queryUser['username'] == $login){
        $query = $pdo->query("DELETE FROM orderproduct WHERE id='$orderProductId'");        
        return $query;
    }else
    {
        return null;
    } 
    
}

function acceptOrder($login, $pdo){
    $userId = getUserId($login, $pdo);
    $query = $pdo->query("UPDATE orders set isAccepted = 1 where userId = '$userId'");

    return $query;
}

function getOrdersToClose($pdo) {
    $query = $pdo->query("SELECT users.username, orders.id, users.firstName, users.lastName from orders inner join users on orders.userId = users.id where isAccepted = 1 and isClosed = 0");

    return $query;
}

function getOrder($orderNumber, $pdo) {
    $order = $pdo->query("SELECT users.firstName, users.lastName, orders.id, orders.orderDate from orders inner join users on orders.userId = users.id where orders.id='$orderNumber'");
    $order = $order->fetch(PDO::FETCH_ASSOC);
    $products = $pdo->query("SELECT products.name, products.price from orderproduct INNER JOIN products on products.id = orderproduct.ProductId where orderproduct.orderId = '$orderNumber'");
    return [
        "order" => $order,
        "products" => $products
    ];
}

function closeOrder($orderId, $pdo) {
    $order = $pdo->query("UPDATE orders set isClosed=1 WHERE id = '$orderId'");

    return $order;
}