<?php

class Announcement
{

    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function createAnnouncement($codUser, $userName)
    {
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
            $connection = GetConnection();
            $stmt = $connection->prepare('INSERT INTO announcement (title, description, address, payment, codUser, user) VALUES (:title, :description, :address, :payment, :codUser, :user)');
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':address', $_POST['address']);
            $stmt->bindParam(':payment', $_POST['payment']);
            $stmt->bindParam(':codUser', $codUser);
            $stmt->bindParam(':user', $userName);

            if ($stmt->execute()) {
                $_SESSION['announcement'] = 'Anuncio cadastrado';
                header('Location: profile.php');
            }
        }
    }

    public function showsAnnouncement($codUser)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT * FROM announcement ORDER BY id DESC');
        $stmt->execute();
        $announcement = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!count($announcement)) {
            echo "<div class='card col s12 colorBack'>
            <div class='card-content black-text'>
                <span class='card-title center'>Nada a exibir</span>
            </div>
        </div>";
        }

        foreach ($announcement as $announcement) {
            $stmtWhile = $connection->prepare('SELECT codUser FROM announcementCandidates WHERE announcementId = :announcementId AND codUser = :codUser');
            $stmtWhile->bindParam(':announcementId', $announcement["id"]);
            $stmtWhile->bindParam(':codUser', $codUser);
            $stmtWhile->execute();
            $userVerify = $stmtWhile->fetch(PDO::FETCH_ASSOC);

            if ($userVerify) {
                echo '<div class="card "> 
            <div class="card-content black-text yellow lighten-3"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applyingAnnouncement.php/?announcement=' . $announcement["id"] . '&user=' . $codUser . ' " class="btn-flat black-text left col s12 hoverable disabled">Você já se candidatou a vaga</a>
            <a href="user.php/?id=' . $announcement["codUser"] . '" class="btn-flat grey-text text-darken-3 col s12">Visitar perfil de ' . $announcement["user"] . '</a> <br> 
            </div> 
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>';
            } elseif ($announcement['codUser'] == $codUser) {
                echo '<div class="card "> 
            <div class="card-content black-text white"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applyingAnnouncement.php/?announcement=' . $announcement["id"] . '&user=' . $codUser . ' " class="disabled btn-flat black-text left col s12 hoverable">Este anúncio é seu</a>
            <a href="user.php/?id=' . $announcement["codUser"] . '" class="btn-flat grey-text text-darken-3 col s12">Visitar perfil de ' . $announcement["user"] . '</a> <br> 
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
            <span class="card-title light"> ' . $announcement["title"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applyingAnnouncement.php/?announcement=' . $announcement["id"] . '&user=' . $codUser . ' " class="btn-flat black-text left col s12 hoverable">Candidatar-se a oferta</a>
            <a href="user.php/?id=' . $announcement["codUser"] . '" class="btn-flat grey-text text-darken-3 col s12">Visitar perfil de ' . $announcement["user"] . '</a> <br> 
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

    public function showsAnnouncementUser($codUserProfile, $codUser)
    {
        $connection = GetConnection();

        $stmt = $connection->prepare('SELECT * FROM announcement WHERE codUser = :id ORDER BY id DESC');
        $stmt->bindParam(':id', $codUserProfile);
        $stmt->execute();
        $announcement = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!count($announcement)) {
            echo "<div class='card col s12 colorBack'>
            <div class='card-content black-text'>
                <span class='card-title center'>Nada a exibir</span>
            </div>
        </div>";
        }

        foreach ($announcement as $announcement) {

            $stmtWhile = $connection->prepare('SELECT codUser FROM announcementcandidates WHERE announcementId = :announcementId AND codUser = :codUser');
            $stmtWhile->bindParam(':announcementId', $announcement["id"]);
            $stmtWhile->bindParam(':codUser', $codUser);
            $stmtWhile->execute();
            $userVerify = $stmtWhile->fetch(PDO::FETCH_ASSOC);

            if ($userVerify) {
                echo '<div class="col s12">
                <div class="card "> 
            <div class="card-content black-text colorBack"> 
            <div class="chip right">Função- anuncio</div> 
            <span class="card-title light"> ' . $announcement["title"] . ' </span> 
            <p class="" style="text-align: justify;"> ' .  $announcement["description"] . ' </p> 
            <hr>
            <p class="title" style="text-align: justify;">' .  $announcement["address"] . ' </p>
            <p class="green-text text-darken-3">R$ ' . $announcement["payment"] . '</p> </div> 
            <div class="card-action col s12 grey lighten-3"> 
            <a href="applyingAnnouncement.php/?announcement=' . $announcement["id"] . '&user=' . $codUser . ' " class="btn-flat black-text left col s12 hoverable disabled">Você já se candidatou a vaga</a>
            </div> 
            </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>';
            } else {
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
            <a href="../applyingAnnouncement.php/?announcement=' . $announcement["id"] . '&user=' . $codUser . ' " class="btn-flat black-text left col s12 hoverable">Candidatar-se a oferta</a>
            </div>
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

    public function showsAnnouncementProfile($codUser)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT * FROM announcement WHERE codUser = :codUser ORDER BY id DESC');
        $stmt->bindParam(':codUser', $codUser);
        $stmt->execute();
        $announcement = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!count($announcement)) {
            echo "<div class='card col s12 colorBack'>
            <div class='card-content black-text'>
                <span class='card-title center'>Nada a exibir</span>
            </div>
        </div>";
        }

        foreach ($announcement as $announcement) {
            $this->showsCandidate($announcement['id']);

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
    }

    public function showsCandidate($announcementId)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('SELECT codUser FROM announcementCandidates WHERE announcementId = :announcementId');
        $stmt->bindParam(':announcementId', $announcementId);
        $stmt->execute();
        $userFor = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo '<div id="candidatos' . $announcementId . '" class="modal">
        <div class="modal-content">
        <h4>Candidatos</h4>';

        if (!$userFor) {
            echo "<div class='card col s12 colorBack'>
            <div class='card-content black-text'>
                <span class='card-title center'>Não houveram candidatos</span>
            </div>
        </div>";
        } else {

            echo '<ul class="collection">';

            foreach ($userFor as $user) {
                $stmt = $connection->prepare('SELECT name, photo, id FROM user WHERE id = :codUser');
                $stmt->bindParam(':codUser', $user['codUser']);
                $stmt->execute();
                $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($userInfo as $user) {
                    echo '<li class="collection-item avatar">
                    <img src="' . $user["photo"] . '" alt="" class="circle">
                    <span class="title">' . $user["name"] . '</span>
                    <a href="user.php/?id='. $user["id"] .'" class="secondary-content right">Visitar Perfil</a><br>
                    <a class=" btn-flat">Escolher como empregado</a>
                  </li>';
                }
            }
            echo '</ul>';
        }
        echo '</div>
            <div class="modal-footer">
            <a href="#!" class="modal-close btn-flat">Close</a>
            </div>
            </div>';
    }



    public function announcementApplying($codUser, $announcementId)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('INSERT INTO announcementCandidates (codUser, announcementId) VALUES (:codUser, :announcementId)');
        $stmt->bindParam(':codUser', $codUser);
        $stmt->bindParam(':announcementId', $announcementId);

        if ($stmt->execute()) {
            $_SESSION['notice'] = 'Você se candidatou a vaga';
            header('Location: ../home.php');
        }
    }

    public function deletingAnnouncement($announcementId)
    {
        $connection = GetConnection();
        $stmt = $connection->prepare('DELETE FROM announcement WHERE id = :id');
        $stmt->bindParam(':id', $announcementId);

        if ($stmt->execute()) {
            $_SESSION['notice'] = 'Anúncio Excluído';
            header('Location: ../home.php');
        }
    }

    public function __construct()
    {
        @session_start();
    }
}
