<?php

    class logOff{

        public function goingOut(){

            setcookie('token');
            unset($_SESSION['fastLogin']);
            header('Location: index.php');
        }

        public function __construct(){
            session_start();
            $this -> goingOut();
        }
    }