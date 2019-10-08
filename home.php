<?php
require 'header.php';
require 'class/Authenticate.class.php';
require 'class/Announcement.class.php';

$authenticate = new authenticate($_COOKIE['token']);

?>

<script type='text/javascript'>
    window.onload = function() {
        <?php if (@$_SESSION['notice'] != '') { ?>
            M.toast({
                html: '<?php echo $_SESSION['notice'] ?>'
            });
        <?php } ?>
    }
</script>

<style>
    #search::-webkit-input-placeholder {
        color: #000;
        font-style: bold;
    }
</style>

<ul id='dropdown1' class='dropdown-content'>
    <li><a href='profile.php' class='grey-text text-darken-3'>Meu Perfil</a></li>
    <li class='divider'></li>
    <li><a href='goingOut.php' class='red-text text-lighten-1'>Encerar Sessão</a></li>
</ul>

<nav>
    <div class='nav-wrapper white'>
        <ul class='right hide-on-med-and-down'>
            <li><a href='' class='grey-text text-darken-3'>Usúarios</a></li>

            <li><a class='dropdown-trigger black-text grey-text text-darken-3' href='#!' data-target='dropdown1'><?php echo $authenticate->getUser(); ?><i class='material-icons right'>arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>

<br><br>

<div class='row col s12'>

    <div class='col s3'>
        <div class='card hoverable blue lighten-3'>
            <div class='card-content black-text'>
                <span class='card-title'>Melhores Usuários <span class='right'>:)</span></span>

            </div>
            <ul class='collection'>

                <li class='collection-item avatar'>
                    <img src='../users/photos/cintia.jpg' alt='' class='circle'>
                    <span class='title'>Cintia Barbosa</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>5.01
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='../users/photos/julia.jpg' alt='' class='circle'>
                    <span class='title'>Julia</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>5.01
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='../users/photos/daniel.jpg' alt='' class='circle'>
                    <span class='title'>Daniel Oliveira</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>4.97
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='../users/photos/matheus.jpg' alt='' class='circle'>
                    <span class='title'>Matheus Magalhães</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>4.95
                    </p>
                </li>

                <nav>
                    <div class='nav-wrapper blue lighten-3'>
                        <form>
                            <div class='input-field'>
                                <input id='search' type='search' placeholder='Pesquisar Usuário' required>
                                <label class='label-icon' for='search'><i class='material-icons black-text'>search</i>Pesquisar Usuário</label>
                                <i class='material-icons'>close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </ul>
        </div>
    </div>

    <div class='col s7'>

        <div class='card blue lighten-3'>
            <div class='card-content black-text'>
                <span class='card-title center'>Últimos Anúncios</span>
            </div>
        </div>

        <?php

        $codUserAuth = $authenticate->getID();
        $announcement = new announcement();
        $announcement->showsAnnouncement($codUserAuth);

        ?>

    </div>

    <div class='col s2 hide-on-med-and-down'>
        <div class='card blue lighten-3'>
            <div class='card-content black-text´blue lighten-3'>
                <span class='card-title center h6'> </span>
                <span class='h3'>   </span>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>

    </div>
</div>

<?php
require 'footer.php';
?>