<nav class="main-nav">
    <ul>
        <li><a href="/index.php">Strona główna</a></li>
        <?php
        if(!$loginSession) echo '<li><a href="/login.php">Logowanie</a></li>';
        if(!$loginSession) echo '<li><a href="/register.php">Rejestracja</a></li>';
        if($loginSession) echo '<li><a href="/logout.php">Wyloguj</a></li>';
        if($loginSession) echo '<li><a href="/zamowienia.php">Zamówienia</a></li>';
        ?>
    </ul>
</nav>