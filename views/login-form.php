<?php 
include("database/database.php");
session_start();
if(isset($_SESSION["login"])){
 header("location: index.php");
 die();
}
$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST") {   
   $username = htmlspecialchars($_POST['username']);
   $password = htmlspecialchars($_POST['password']); 
   
   $sql = "SELECT id, password FROM users WHERE username = '$username'";
   $result = $pdo->query($sql);
   $row = $result->fetch(PDO::FETCH_ASSOC);
   
   $isPasswordCorrect = password_verify($password, $row['password'] ?? null);   
      if($isPasswordCorrect) {
      if(!isset($_SESSION["login"])){
            $_SESSION['login'] = $username;
            header("location: index.php");
      }         
      }else {
         $error = "Podałeś nieprawidłowy login lub hasło";
      }
   }
?>

<div class="login">
  <div class="form">
    <form method="POST" action="" class="login-form">
      <p class="login-title">Logowanie</p>
      <input name="username" type="text" placeholder="EMAIL" required/>
      <input name="password" type="password" placeholder="HASŁO" required />
      <button>Zaloguj</button>
      <a class="form-link" href="/register.php">Rejestracja</a>
    </form>  
  </div>
</div>