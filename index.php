<?php
include('session.php');
include('database/databasefunctions.php');

$products = getAllProducts($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include('components/navigation.php'); ?>
     <h1>Witamy w sklepie Sklepooo</h1>

     <div class="shop">
         <h3>Wybierz interesujące Cię produkty</h1>
         <div class="products">
             <?php
                foreach($products as $product){
                    $id = $product['id'];
                    echo '<a href="product.php/?id=' . $id . '" class="product">';
                    echo '<p class="title">Nazwa: '. $product['name'] .'</p>';
                    echo '<p class="price">Cena: '. $product['price'] .'</p>';
                    echo '<p class="quantity">Dostępna ilość: '. $product['quantity'] .'</p>';
                    echo '<img src="'. $product['imageUrl'] .'" alt="'. $product['name'] .' zdjęcie">';
                    echo '</a>';
                }
             ?>
         </div>
        <img src="" alt="">
     </div>

<script src="js/main.js"></script>
</body>
</html>