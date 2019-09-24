<?php

class AccountLogin
{

    public $erros = array();

    // public function setErros($erros)
    // {
    //     $this->erros = $erros;
    // }

    // public function getErros()
    // {
    //     return $this->erros;
    // }

    public function setSit($sit)
    {
        $this->sit = $sit;
    }

    public function getSit()
    {
        return $this->sit;
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

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function loggingIn()
    {

        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT email FROM user WHERE email = :email');
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $this->erros[] = 'E-mail não registrado, você pode se cadastrar <a href="register.php">aqui</a>';
        } else {
            $stmt = $connection->prepare('SELECT id FROM user WHERE email = :email AND password = :password');
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->execute();

            if ($stmt->rowCount()) {
                $sit = date('B');
                $tokenUser = md5(mt_rand(10, 50));
                $token = base64_encode($tokenUser . $sit);
                setcookie('token', $token);

                $stmt = $connection->prepare('UPDATE user SET token = :token, sit = :logintime  WHERE email = :email');
                $stmt->bindParam(':logintime', $sit);
                $stmt->bindParam(':token', $tokenUser);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->execute();

                header('Location: home.php');
            } else {
                $this->erros[] = 'E-mail ou senha incorreto';
            }
        }

        if (count($this->erros)) {
            $_SESSION['error'] = $this->erros;
            header('Location: index.php');
        }
    }

    public function registration()
    {
        $erros = array();
        $connection = GetConnection();
        $stmt  = $connection->prepare('SELECT email FROM user WHERE email = :email');
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        if (strlen($_POST['name']) < 4 || $_POST['name'] == NULL || strlen($_POST['name']) > 33) {
            $this->erros[] = 'O campo nome não pode ser menor que 4 e maior que 32';
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->erros[] = 'O e-mail digitado não é valido';
        }
        if (strlen($_POST['email']) == 0 || $_POST['email'] == NULL) {
            $this->erros[] = 'E-mail não digitado';
        }
        if ($stmt->rowCount() > 0) {
            $this->erros[] = 'E-mai já cadastrado';
        }
        if (strlen($_POST['password']) < 7 || strlen($_POST['password']) > 33) {
            $this->erros[] = 'O campo senha não pode ser menor que 7 e maior que 32';
        }
        if ($_POST['password'] !== $_POST['password2']) {
            $this->erros[] = 'Senhas não correspondem';
        }

        // if(!strlen($_POST['cpf'])){
        //     array_push($erros, 'cpf not sent');
        // }

        if (!count($this->erros)) {
            $photo = "users/photos/Person.jpg";
            $connection = GetConnection();
            $stmt = $connection->prepare('INSERT INTO user (name, email, photo, password, telephone) VALUES (:name, :email, :photo, :password, :telephone)');
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->bindParam(':telephone', $_POST['telephone']);

            if ($stmt->execute()) {
                $_SESSION['rnotice'] = '<div class="btn white black-text">Registrado com sucesso!</div>';
                header('Location: index.php');
            } else {
                header('Location: register.php');
            }
        } else {
            $_SESSION['error'] = $this->erros;
            header('Location: register.php');
        }
    }

    public function accountShowing($id)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT name, email, telephone, photo FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setName($user['name']);
        $this->setEmail($user['email']);
        $this->setTelephone($user['telephone']);
        $this->setPhoto($user['photo']);
    }

    public function updateAccount($userId)
    {
        if (($_FILES['photo']['name']) && $_FILES['photo']['error'] == 0) {
            $name_tmp = $_FILES['photo']['tmp_name'];
            $name = $_FILES['photo']['name'];
            list($width, $height) = getimagesize($name_tmp);

            if (($width <= 250) and ($height <= 250)) {
                $_SESSION['announcement'] = 'Imagem muito pequena';
                header('Location: profile.php');
            } else {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $name = md5(uniqid(time())) . '.' . $extension;
                $destination = 'users/photos/' . $name;

                if (!strstr('.jpg; .jpeg; .gif; .png', $extension)) {
                    header('Location: profile.php');
                } else {
                    move_uploaded_file($name_tmp, $destination);
                    $connection = GetConnection();
                    $stmt = $connection->prepare('UPDATE user SET photo = :photo WHERE id = :id');
                    $stmt->bindParam(':photo', $destination);
                    $stmt->bindParam(':id', $userId);
                    $stmt->execute();
                    echo "<script type='text/javascript>
                        localStorage.setItem('photoChanged', 'TRUE');
                    </script>";
                    $_SESSION['photoChanged'] = true;
                    header('Location: profile.php');
                }
            }

            $resizeObj = new resize($destination);
            $resizeObj->resizeImage(500, 500, 'crop');
            $resizeObj->saveImage($destination, 100);
        }
    }

    public function goingOut()
    {

        setcookie('token');
        unset($_SESSION['fastLogin']);
        header('Location: index.php');
    }

    public function __construct()
    {
        @session_start();
        // session_unset(fastlogin);
    }
}
