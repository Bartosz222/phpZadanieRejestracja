<?php
    include('rejestracja.php');
    session_start();
    $user = new user;
    $message ='';
    if(isset($_POST['submit'])){
        $field = array(
            'login'=>$_POST['login'],
            'password'=>$_POST['password'],
        );
        if($user->walidacja($field)){
            if($user->logowanie('users',$field)){
                $_SESSION['login'] = $_POST['login'];
                header("Location: afterLogin.php");
            }
        }
        else $message = $user->error;
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <form method="POST">
            <h1>Logowanie</h1>
            <input type="text" placeholder="Login" name="login">
            <input type="text" placeholder="Password" name="password">
            <input type="submit" value="Zaloguj" name="submit">
        </form>
        <a href="index.php">Rejestacja</a>
        <?php
            if(isset($message)) echo $message;
        ?>
    </div>
</body>
</html>