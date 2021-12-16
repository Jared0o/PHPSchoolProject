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
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Login  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Hasło  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <label>Email  :</label><input type = "email" name = "email" class = "box" /><br/><br />
                  <label>Imię :</label><input type = "text" name = "firstName" class = "box" /><br/><br />
                  <label>Nazwisko  :</label><input type = "text" name = "lastName" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
                  <a href="/login.php">Logowanie</a>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>