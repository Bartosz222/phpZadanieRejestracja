<?php
    include("rejestracja.php");
    
    $user = new user;
    $message = '';
    if(isset($_POST['submit'])){
        $field = array(
            'email'=>$_POST['email'],
            'login'=>$_POST['login'],
            'password'=>$_POST['password'],
            'cpassword'=>$_POST["cpassword"],
        );
        if($user->walidacja($field)){ 
            if($user->rejestracja('users',$field)) header("location: index.php");
            else $message = $user->error;
        }
        else $message = $user->error;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h1>Formularz rejestracji</h1>
        <input type="text" placeholder="E-mail" name="email">
        <input type="text" placeholder="Login" name="login">
        <input type="text" placeholder="Hasło" name="password">
        <input type="text" placeholder="Powtórz hasło" name="cpassword">
        <input type="submit" value="Zatwierdź" name="submit">
    </form>
    <?php
        if(isset($message)){
            echo "$message";
        }
    ?>
</body>
</html>