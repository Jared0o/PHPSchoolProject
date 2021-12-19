<?php
include_once('views/header.php');
include_once('views/nav.php');

$isAdmin = checkAdmin($loginSession, $pdo);

if(!$isAdmin){
    header("location:login.php");
    die();
}

$orders = getOrdersToClose($pdo);

?>
<div class="form form-order" id="form">
<table id="table" id='prod'>
                <tr>
                    <th>Id zamówienia</th>
                    <th>Kupujący</th>                    
                </tr>
                <?php
                foreach($orders as $order){
                    echo '<tr>';
                    echo '<td>'. $order['id'] .'</td>'; 
                    echo '<td>'. $order['firstName'] . ' ' . $order['lastName'] .'</td>';
                    echo '<td><a href="zamowienie-wiecej.php?id='. $order['id'] . '" class="form-link" type="submit">Więcej</a></td>';      
                    echo '</tr>';         
                }
                ?>
            </table>
</div>
<?php
include_once('views/footer.php');