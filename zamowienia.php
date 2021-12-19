<?php
include_once('views/header.php');
include_once('views/nav.php');
$products = getActualOrder($loginSession, $pdo);
$fullPrice = 0;
?>

<div class="form form-order" id="form">
<table id="table" id='prod'>
                <tr>
                    <th>Nazwa</th>
                    <th>Cena</th>  
                    <th>Opcje</th>                  
                </tr>
                <?php
                foreach($products as $prod){
                    $fullPrice += $prod['price'];
                    echo '<tr>';
                    echo '<td>'. $prod['name'] .'</td>'; 
                    echo '<td>'. $prod['price'] .'</td>';
                    echo '<td><button data-orderProduct='.$prod['opId'].' data-method="removeFromOrder" data-id='. $prod['id'] .' class="form-link" type="submit">Usuń</button></td>';      
                    echo '</tr>';         
                }
                ?>
                <tr class='full-price'>

                
                <td class='full-price'>Pełna Cena: <td>
                <td class='full-price'><?php echo $fullPrice ?></td>
                </tr>
            </table>

            <button data-method='acceptOrder' class="form-link btb-order">Realizuj zamówienie</button>
</div>
<?php
include_once('views/footer.php');