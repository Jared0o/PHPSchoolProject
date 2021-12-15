<?php
    //include bazy danych
    include('database.php');
    //uruchomienie sesji
    session_start();
   
    //pobranie usera ze zmiennej sesyjnej
    $userCheck = $_SESSION['login'] ?? null;   

    if($userCheck != null){
        //zapytanie do bazy, wyciągnięcie użytkownika o loginie pobranym z sesji
        $quer = $pdo->query('SELECT login FROM users where login = "$userCheck"');
        //przetworzenie zapytania na tablice asocjacyjną
        $user = $quer->fetch(PDO::FETCH_ASSOC);
    }
    

    //przypisanie loginu sesyjnego do zmiennej
    $loginSession = $user['login'] ?? null;
   
    if(!isset($_SESSION['login'])){
        header("location:login.php");
        die();
    }