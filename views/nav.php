<?php
    include_once('functions/session.php');
    include_once('database/databasefunctions.php');

    $isAdmin = checkAdmin($loginSession, $pdo);
?>


<nav class="main-nav">
    <ul class="nav-list">
        <li class="nav-item"><a class="nav-link" href="/index.php">Strona główna</a></li>
        <?php
        if($loginSession) echo '<li class="nav-item"><a class="nav-link" href="/zamowienia.php">Twoje Zamówienia</a></li>';
        if(!$loginSession) echo '<li class="nav-item"><a class="nav-link" href="/login.php">Logowanie</a></li>';
        if(!$loginSession) echo '<li class="nav-item"><a class="nav-link" href="/register.php">Rejestracja</a></li>';
        if($loginSession) echo '<li class="nav-item"><a class="nav-link" href="/logout.php">Wyloguj</a></li>';
        if($isAdmin) echo '<li class="nav-item"><a class="nav-link" href="/admin.php">Zarządzanie produktami</a></li>';
        if($isAdmin) echo '<li class="nav-item"><a class="nav-link" href="/zamowienia-realizacja.php">Zamówienia do realizacji</a></li>';
        ?>
    </ul>
</nav>