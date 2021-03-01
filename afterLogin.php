<?php 
    session_start();
?>
<html>
    <body>
        <?php if(isset($_SESSION['login'])):?>
        Cześć, <?=$_SESSION['login']?>
        <a href="logout.php">Wyloguj</a>
        <?php else :?>
            <?php header("location: main.php");?>
        <?php endif;?>
    </body>
</html>