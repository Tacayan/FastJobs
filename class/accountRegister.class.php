<?php
// require 'database/connection.php';

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

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function registration()
    {

        $connection = GetConnection();
        $stmt  = $connection->prepare('SELECT email FROM user WHERE email = :email');
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        if (strlen($_POST['name']) < 4 || $_POST['name'] == NULL || strlen($_POST['name']) > 33) {
            $this->$erros[] = 'O campo nome não pode ser menor que 4 e maior que 32';
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->$erros[] = 'O e-mail digitado não é valido';
        }
        if (strlen($_POST['email']) == 0 || $_POST['email'] == NULL) {
            $this->$erros[] = 'E-mail não digitado';
        }
        if ($stmt->rowCount() > 0) {
            $this->$erros[] = 'E-mai já cadastrado';
        }
        if (strlen($_POST['password']) < 7 || strlen($_POST['password']) > 33) {
            $this->$erros[] = 'O campo senha não pode ser menor que 7 e maior que 32';
        }
        if ($_POST['password'] !== $_POST['password2']) {
            $this->$erros[] = 'Senhas não correspondem';
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

    public function accountShowing($id)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT name, email, telephone FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setName($user['name']);
        $this->setEmail($user['email']);
        $this->setTelephone($user['telephone']);
    }

    public function __construct()
    {
        @session_start();
    }
}
