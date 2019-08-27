<?php
require 'database/connection.php';

class authenticate
{

    public $erros = array();
    public $user, $email, $telephone, $sit, $token, $id;

    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setSit($sit)
    {
        $this->sit = $sit;
    }

    public function getSit()
    {
        return $this->sit;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
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

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function authentication($sit, $tokenVar)
    {

        $sitToken = substr(base64_decode($_COOKIE['token']), -3);

        if (($sit == FALSE) or (strlen($_COOKIE['token'] == '0') or ($this->getSit() != $sitToken))) {
            $this->$erros[] = 'Token inválido/ Sessão expirada (Faça login ou <a href="register.php">registro </a>)';

            if (count($this->$erros)) {
                $_SESSION['error'] = $this->$erros;
                header('Location: index.php');
            }
        }

        $connection = getConnection();
        $stmt = $connection->prepare('SELECT name, email, telephone, id FROM user WHERE token = :token');
        $stmt->bindParam(':token', $tokenVar);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setUser($user['name']);
        $this->setEmail($user['email']);
        $this->setTelephone($user['telephone']);
        $this->setID($user['id']);
    }

    public function checkLogin($sit)
    {

        if ($sit != '') {
            $_SESSION['fastLogin'] = '<a href="home.php" class="black-text white btn"> ' . $this->getUser() . ' (Login rápido)</a> <a href="goingOut.php" class="btn yellow lighten-1 hoverable black-text">Sair</a>';
        } else {
            unset($_SESSION['fastLogin']);
        }
    }

    public function __construct($token)
    {
        @session_start();

        $this->setToken(substr(base64_decode($token), 0, 32));
        $tokenVar = $this->getToken();

        $connection = getConnection();
        $stmt = $connection->prepare('SELECT sit FROM user WHERE token = :token');
        $stmt->bindParam(':token', $tokenVar);
        $stmt->execute();
        $sit = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setSit($sit['sit']);

        $this->authentication($this->getSit(), $this->getToken());
        $this->checkLogin($this->getSit());
    }
}
