<?php
include('../session.php');
include('../database/databasefunctions.php');
if(!checkAdmin($loginSession, $pdo)){
    header("location:/index.php", true);
        die();
}

$user = getUser($loginSession, $pdo);
print_r($user);
$error = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
if($_POST['name'] && $_POST['quantity'] && $_POST['price'] ){
    $article = [
        "name" => htmlspecialchars($_POST['name']),
        "quantity" => htmlspecialchars($_POST['quantity']),
        "price" => htmlspecialchars($_POST['price']),
    ];
    $res = addArticle($article, $pdo);

}else{
    $error = 'Nie podałeś któregoś ze składników';
}
}

$products = getAllProducts($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklepooo - Panel administratora</title>
</head>
<body>
    <h3>Witaj <?php echo '<p>' . $user['firstName'] . ' ' . $user['lastName'] . '</p>' ?></h3>
    <h4>Co chcesz zrobić</h4>
    <div>
        <div class="left">
            <h5>Artykuły</h5>
            <form method="post" action="admin.php">
                <div>
                    <label for="name">Nazwa artykułu: </label>
                    <input type="text" name="name" require>
                </div>
                <div>
                    <label for="quantity">Ilość: </label>
                    <input type="number" name="quantity" require>
                </div>
                <div>
                    <label for="price">Cena: </label>
                    <input type="number" step="0.01" name="price" require>
                </div>  
                <input type="submit" value="Dodaj">                
                <?php if($error) echo '<p>' . $error . '</p>' ?>                   
            </form>            
        </div>
        <div class="right">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    <th>Opcje</th>
                </tr>
                <?php
                foreach($products as $prod){
                    $id = $prod['id'];
                    echo '<tr>';
                    echo '<td>'. $prod['id'] .'</td>'; 
                    echo '<td>'. $prod['name'] .'</td>'; 
                    echo '<td>'. $prod['quantity'] .'</td>'; 
                    echo '<td>'. $prod['price'] .'</td>'; 
                    echo '<td><a href="/admin/product.php/?id='. $id . '">Więcej</a></td>'; 
                    echo '</tr>';                    
                }
                ?>
            </table>
        </div>
    </div>
    
</body>
</html>

