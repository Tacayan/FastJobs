<?php
    require 'database/connection.php';

    class accountLogin{

        public $erros = array();
        public $sit;

        public function setErros($erros){
            $this -> erros = $erros;
        }

        public function getErros(){
            return $this -> erros;
        }

        public function setSit($sit){
            $this -> sit = $sit;
        }

        public function getSit(){
            return $this -> sit;
        }

        public function loggingIn(){

            $connection = GetConnection();
            $stmt = $connection -> prepare('SELECT email FROM user WHERE email = :email');
            $stmt -> bindParam(':email', $_POST['email']);
            $stmt -> execute();

            if(!$stmt -> rowCount()){
                $this ->  $erros[] = 'e-mail not registered';
            }else{
                $stmt = $connection -> prepare('SELECT id FROM user WHERE email = :email AND password = :password');
                $stmt -> bindParam(':email', $_POST['email']);
                $stmt -> bindParam(':password', $_POST['password']);
                $stmt -> execute();
                $idArray = $stmt -> fetch(PDO::FETCH_ASSOC);

                if($stmt -> rowCount()){
                    $sit = date('B');
                    $tokenUser = md5(mt_rand(10,50));
                    $token = base64_encode($tokenUser.$sit);
                    setcookie('token', $token);

                    $stmt = $connection -> prepare('UPDATE user SET token = :token, sit = :logintime  WHERE email = :email');
                    $stmt -> bindParam(':logintime', $sit);
                    $stmt -> bindParam(':token', $tokenUser);
                    $stmt -> bindParam(':email', $_POST['email']);
                    $stmt -> execute();

                    echo $sit;
                    
                    header('Location: home.php');
                }else{
                    $this -> $erros[] = 'email or password incorrect';
                }
            }

            if(count($this -> $erros)){
                $_SESSION['error'] = $this -> $erros;
                header('Location: index.php');
            }
        }

        public function __construct(){
            session_start();

        }
    }
