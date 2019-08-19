<?php
require 'database/connection.php';

class accountRegister
{

    public $erros = array();

    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function registration()
    {

        $connection = GetConnection();
        $stmt  = $connection->prepare('SELECT email FROM user WHERE email = :email');
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        if (strlen($_POST['name']) < 4 || $_POST['name'] == NULL || strlen($_POST['name']) > 32) {
            $this->$erros[] = 'the name must be longer than 4 characters and less than 32 characters';
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->$erros[] = 'your e-mail address is not in a valid e-mail format';
        }
        if (strlen($_POST['email']) == 0 || $_POST['email'] == NULL) {
            $this->$erros[] = 'empty e-mail';
        }
        if ($stmt->rowCount() > 0) {
            $this->$erros[] = 'E-mail already registered';
        }
        if (strlen($_POST['password']) < 7 || strlen($_POST['password']) > 33) {
            $this->$erros[] = 'the password must be longer than 7 characters and less than 32 characters';
        }
        if ($_POST['password'] !== $_POST['password2']) {
            $this->$erros[] = 'Password and password repeat are not the same';
        }
        // if(!strlen($_POST['cpf'])){
        //     array_push($erros, 'cpf not sent');
        // }

        if (!count($this->$erros)) {
            $connection = GetConnection();
            $stmt = $connection->prepare('INSERT INTO user (name, email, password, telephone) VALUES (:name, :email, :password, :telephone)');
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->bindParam(':telephone', $_POST['telephone']);

            if ($stmt->execute()) {
                $_SESSION['registration'] = '<div class="btn white black-text">Registrado com sucesso!</div>';
                header('Location: index.php');
            } else {
                header('Location: register.php');
            }
        } else {
            $_SESSION['error'] = $this->$erros;
            header('Location: register.php');
        }
    }

    public function __construct()
    {
        session_start();
    }
}
