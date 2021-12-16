<?php
    //include bazy danych
    include('database/database.php');
    //uruchomienie sesji
    session_start();
   
    //pobranie usera ze zmiennej sesyjnej
    $userCheck = $_SESSION['login'] ?? null;
    $loginSession = null;

    if($userCheck != null){
        //zapytanie do bazy, wyciągnięcie użytkownika o loginie pobranym z sesji
        $quer = $pdo->query("SELECT username FROM users where username = '$userCheck'");
        //przetworzenie zapytania na tablice asocjacyjną
        $user = $quer->fetch(PDO::FETCH_ASSOC);
        $loginSession= $user['username'] ?? null;
    }
    

    //przypisanie loginu sesyjnego do zmiennej
     
   
    if(!isset($_SESSION['login'])){
        header("location:login.php");
        die();
    }