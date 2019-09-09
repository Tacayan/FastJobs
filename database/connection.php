<?php
    function GetConnection(){
        try{
            $pdo = new PDO('mysql:host=localhost;port=777;dbname=fastjobs;charset=utf8', 'root', '');
            return $pdo;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }