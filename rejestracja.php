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
            $stmt = $this->conn->prepare("INSERT INTO $tabela (e-mail,login,haslo) values (:e-mail,:login,:haslo)");
            $stmt->bindParam(':e-mail',$email,PDO::PARAM_STR);
            $stmt->bindParam(':login',$login,PDO::PARAM_STR);
            $stmt->bindParam(':haslo',$password,PDO::PARAM_STR);
            if($password == $cpassword){
                $stmt->execute();
                header("location: index.php");
            }
            else $this->error = "Hasła muszą być takie same";
        }
    }
?>