<?php
$products = getAllActiveProducts($pdo);
checkOrderExist($loginSession, $pdo);
?>


<section class="shop">
    <h3 class="shop-title">Nasze produkty</h3>
    <div class="products" id='prod'>
        <?php foreach($products as $product): ?>
        <div class="product">
            <div class="product-text">
                <h4 class="product-title"><?php echo $product['name'] ?></h4>
                <p class="product-price">Cena: <?php echo $product['price'] ?></p>
                <button class="product-button form-link" data-id="<?php echo $product['id'] ?>">Dodaj</button>  
            </div>
            <img class="product-img" src="<?php echo $product['img'] ?>" alt="">
        </div>
        <?php endforeach; ?>        
    </div>
</section>