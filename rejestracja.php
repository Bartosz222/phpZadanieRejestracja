<?php
    class user{
        public $conn,$error;
        public function __construct(){
            try{
                $this->conn = new PDO("mysql:host=localhost;dbname=uzytkownicy","root","");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $error){
                echo 'Błąd'.$error->getMessage();
            }
        }
        public function walidacja($field){
            $count= 0;
            foreach($field as $k => $v){
                if(empty($v)){
                    $count++;
                    $this->error .= "<p>". $k . ": Pole jest puste</p>";
                }
            }
            if($count==0){
                return true;
            }
            else return false;
        }
        public function rejestracja($tabela,$field){
            $login = $field['login'];
            $email = $field['email'];
            $password = $field['password'];
            $cpassword = $field['cpassword'];
            $stmt = $this->conn->prepare("INSERT INTO $tabela (email,login,haslo) values (:email,:login,:haslo)");
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':login',$login,PDO::PARAM_STR);
            $stmt->bindParam(':haslo',$password,PDO::PARAM_STR);
            if($password == $cpassword){
                $stmt->execute();
                header("location: main.php");
            }
            else $this->error = "Hasła muszą być takie same";
        }
        public function logowanie($tabela,$field){
            $login=$field['login'];
            $password=$field['password'];
            $stmt=$this->conn->prepare("SELECT * FROM $tabela WHERE login=:login AND haslo=:haslo");
            $stmt->bindParam(':login',$login,PDO::PARAM_STR);
            $stmt->bindParam(':haslo',$password,PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()<=0) $this->error="Błedny login lub hasło";
            else return true;
        }
    }
?>