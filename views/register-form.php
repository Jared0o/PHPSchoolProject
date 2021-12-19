<?php
   include("database/database.php");
   session_start();
   if(isset($_SESSION["login"])){
    header("location: index.php");
    die();
   }
   $error = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
      $email = htmlspecialchars($_POST['email']); 
      $firstName = htmlspecialchars($_POST['firstName']); 
      $lastName = htmlspecialchars($_POST['lastName']); 
      var_dump($hashedPassword);

      $sql = "SELECT id FROM users WHERE username = '$username'";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);      
      
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($row == null) {
          try{
            $sql = "INSERT INTO users (username, password, email, firstName, lastName) VALUES ('$username','$hashedPassword','$email', '$firstName', '$lastName')";
            $result = $pdo->query($sql);
            $_SESSION['login'] = $username;
            header("location: index.php");
            die();
          }catch(PDOException $e){
            $error = 'Coś poszło nie tak spróbuj ponownie'; 
          }
        
         
      }else {
         $error = "Login jest już zajęty";
      }
    }
?>

<div class="login">
  <div class="form">
    <form method="POST" action="" class="login-form">
      <p class="login-title">Rejestracja</p>
      <input type="text" name="username" placeholder="NAZWA UŻYTKOWNIKA" required/>
      <input type="email" name="email" placeholder="EMAIL" required/>
      <input type="password" name="password" placeholder="HASŁO" required />
      <input type="text" name="firstName" placeholder="IMIĘ" required />
      <input type="text" name="lastName" placeholder="NAZWISKO" required />
      <button>Rejestruj</button>
      <a class="form-link" href="/login.php">Logowanie</a>
    </form>  
  </div>
</div>