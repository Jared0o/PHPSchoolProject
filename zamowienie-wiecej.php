<?php
include_once('views/header.php');
include_once('views/nav.php');
$isAdmin = checkAdmin($loginSession, $pdo);

if(!$isAdmin){
    header("location:login.php");
    die();
}
$orderNumber =  $_GET['id'];

$order = getOrder($orderNumber, $pdo);
$price = 0;
?>

<div class="form form-order" id="form">
    <h1 class='order-details'>Numer zamówienia: <?php echo $order['order']['id'] ?> </h1>
    <h2 class='order-details'>Imię nazwisko: <?php echo $order['order']['firstName'] . ' ' .  $order['order']['lastName'] ?> </h2>
    <h3 class='order-details'>Data zakupu: <?php echo $order['order']['orderDate'] ?></h3>
<table id="table" id='prod'>
                <tr>
                    <th class="order-details">Produkt</th>
                    <th class="order-details">Cena</th>                    
                </tr>
                <?php
                foreach($order['products'] as $or){
                    $price += $or['price'];
                    echo '<tr>';
                    echo '<td class="order-details">'. $or['name'] .'</td>'; 
                    echo '<td class="order-details">'. $or['price'] .'</td>';
                    echo '</tr>';         
                }
                ?>
                <tr>
                    <td class='order-details'>Cena Całkowita</td>
                    <td class='order-details'><?php echo $price  ?>zł</td>
                </tr>
            </table>
            <button data-method='closeOrder' data-id="<?php echo $order['order']['id'] ?>" class="form-link" type="submit">Zatwierdź zamówienie</button>
</div>




<?php 

include_once('views/footer.php');