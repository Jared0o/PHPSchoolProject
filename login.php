<?php
   include("database.php");
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
      
      $sql = "SELECT id FROM users WHERE login = '$username' and haslo = '$password'";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);      
      
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($row != null && count($row) == 1) {
        if(!isset($_SESSION["login"])){
            $_SESSION['login'] = $username;
            header("location: index.php");
        }
         
      }else {
         $error = "Podałeś nieprawidłowy login lub hasło";
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
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>