<?php
include_once('views/header.php');
include_once('views/nav.php');
include_once('database/databasefunctions.php');

if(!checkAdmin($loginSession, $pdo)){
    header("location:/index.php", true);
        die();
}

$user = getUser($loginSession, $pdo);
$error = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
if($_POST['name'] && $_POST['img'] && $_POST['price'] ){
    $article = [
        "name" => htmlspecialchars($_POST['name']),
        "img" => htmlspecialchars($_POST['img']),
        "price" => htmlspecialchars($_POST['price']),
    ];
    $res = addArticle($article, $pdo);

}else{
    $error = 'Nie podałeś któregoś ze składników';
}
}


$products = getAllProducts($pdo);



?>
<section class="admin-panel">
    <h3 class = "admin-title">Witaj <?php echo '<p>' . $user['firstName'] . ' ' . $user['lastName'] . '</p>' ?></h3>
    
    <h4 class="form-title">Co chcesz dodać</h4>
    <div class="form admin-form">
        <div class="left">
            <h5>Artykuły</h5>
            <form method="post" action="">
                <div>
                    <label>Nazwa artykułu: </label>
                    <input type="text" name="name" require>
                </div>
                <div>
                    <label>Cena: </label>
                    <input type="number" step="0.01" name="price" require>
                </div>
                <div>
                    <label>Link do zdjęcia: </label>
                    <input type="text" name="img" require>
                </div>

                <button class="form-link" type="submit">Dodaj</button>                
                <?php if($error) echo '<p>' . $error . '</p>' ?>                   
            </form>            
        </div>
        <div class="right">
            <table id="table">
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Cena</th>
                    <th>Czy aktywny</th>
                    <th>Opcje</th>                    
                </tr>
                <?php
                foreach($products as $prod){
                    $id = $prod['id'];
                    echo '<tr>';
                    echo '<td>'. $prod['id'] .'</td>'; 
                    echo '<td>'. $prod['name'] .'</td>';  
                    echo '<td>'. $prod['price'] .'</td>';
                    echo '<td>'. $prod['isActive'] .'</td>';  
                    echo '<td><button data-method="delete" data-id='. $id .' class="form-link" type="submit">Usuń</button></td>'; 
                    echo '<td><button data-method="active" data-id='. $id .' class="form-link" type="submit">Aktywuj</button></td>'; 
                    echo '</tr>';                    
                }
                ?>
            </table>
        </div>
    </div>
</section>

<?php include_once('views/footer.php'); ?>


