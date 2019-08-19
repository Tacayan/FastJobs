<?php
// require 'database/connection.php';
// require 'class/authenticate.class.php';

class announcement
{

    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function createAnnouncement()
    {
        require 'class/authenticate.class.php';
        if ($_POST['payment'] == '') {
            $this->setErros('Teu corno, vai pagar em cu é filho da puta??????????????????????????');
        }
        if (strlen($_POST['description']) < 10) {
            $this->setErros('Descrição é muita pequena');
        }
        if (strlen($_POST['address']) < 15) {
            $this->setErros('Endereço é muito pequeno');
        }
        if (strlen($_POST['title']) < 10) {
            $this->setErros('Título é muito pequeno');
        }

        if ($this->getErros()) {
            $_SESSION['announcement'] = $this->getErros();
            header('Location: profile.php');
        } else {
            $authenticate = new authenticate();
            $id = $authenticate->getID();
            $user = $authenticate->getUser();
            $connection = GetConnection();
            $stmt = $connection->prepare('INSERT INTO announcement (title, description, address, payment, codUser, user) VALUES (:title, :description, :address, :payment, :codUser, :user)');
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':address', $_POST['address']);
            $stmt->bindParam(':payment', $_POST['payment']);
            $stmt->bindParam(':codUser', $id);
            $stmt->bindParam(':user', $user);

            if ($stmt->execute()) {
                $_SESSION['announcement'] = 'Anuncio cadastrado';
                header('Location: profile.php');
            }
        }
    }

    public function showsAnnouncement($userId)
    {
        $connection = GetConnection();

        $stmt = $connection->prepare('SELECT * FROM announcement ORDER BY id DESC');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        while ($announcement = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmtWhile = $connection->prepare('SELECT userId FROM announcementCandidates WHERE announcementId = :announcementId AND userId = :userId');
            $stmtWhile->bindParam(':announcementId', $announcement["id"]);
            $stmtWhile->bindParam(':userId', $userId);
            $stmtWhile->execute();
            if ($stmtWhile->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card "> 
            <div class="card-content black-text yellow lighten-3"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . $announcement["id"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applying.php/?announcement=' . $announcement["id"] . '&user=' . $userId . ' " class="btn-flat black-text left col s12 hoverable disabled">Você já se candidatou a vaga</a>
            <a href="" class="btn-flat grey-text text-darken-3 col s12">Visitar perfil de ' . $announcement["user"] . '</a> <br> 
            </div> 
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>';
            } else {
                echo '<div class="card "> 
            <div class="card-content black-text white"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . $announcement["id"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applying.php/?announcement=' . $announcement["id"] . '&user=' . $userId . ' " class="btn-flat black-text left col s12 hoverable">Candidatar-se a oferta</a>
            <a href="" class="btn-flat grey-text text-darken-3 col s12">Visitar perfil de ' . $announcement["user"] . '</a> <br> 
            </div> 
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>';
            }
        }
    }

    public function showsannouncementProfile()
    {
        $authenticate = new authenticate();
        $id = $authenticate->getID();
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT * FROM announcement WHERE codUser = :codUser ORDER BY id DESC');
        $stmt->bindParam(':codUser', $id);
        $stmt->execute();

        while ($announcement = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col s12">
            <div class="card "> 
            <div class="card-content black-text white"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a class="btn black-text col s12 white modal-trigger" href="#candidatos' . $announcement["id"] . '"><i class="left material-icons tiny ">list</i>Candidatos(+99)</a><br><br>
            <a class="btn black-text col s12 colorBack" href="deletingAnnouncement.php?id=' . $announcement["id"] . '">Excluir<i class="left material-icons tiny ">delete</i></a><br><br> 
            </div> 
            </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>';
        }
        // $this->showsCandidate("35");
    }

    // public function showsCandidate($announcementId)
    // {
    //     $connection = GetConnection();
    //     $stmt = $connection->prepare('SELECT name FROM users WHERE ')
    // }

    public function announcementApplying($userId, $announcementId)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('INSERT INTO announcementCandidates (userId, announcementId) VALUES (:userId, :announcementId)');
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':announcementId', $announcementId);

        if ($stmt->execute()) {
            $_SESSION['notice'] = 'Você se candidatou a vaga';
            header('Location: ../home.php');
        }
    }

    public function __construct()
    {
        @session_start();
    }
}
