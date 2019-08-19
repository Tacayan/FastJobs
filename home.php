<?php
require 'header.php';
require 'class/authenticate.class.php';
require 'class/announcement.class.php';

$authenticate = new authenticate();

?>

<script type='text/javascript'>
    window.onload = function() {
            <?php if (@$_SESSION['notice'] != '') { ?>
            M.toast({
                html: '<?php echo $_SESSION['notice'] ?>'
            });
            <?php } ?>
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
                    <img src='https://instagram.fcgh11-1.fna.fbcdn.net/vp/7fff84edb5308dba1bcf8c8c8666fdea/5D626459/t51.2885-19/s150x150/56739396_333393914033790_3678874337835745280_n.jpg?_nc_ht=instagram.fcgh11-1.fna.fbcdn.net' alt='' class='circle'>
                    <span class='title'>Cintia Barbosa</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>5.01
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='https://instagram.faep12-1.fna.fbcdn.net/vp/d42a494fc2402d8bd8c0778db0ee5e0c/5DB92B0D/t51.2885-19/s150x150/65556681_2344669842480134_7219431796524449792_n.jpg?_nc_ht=instagram.faep12-1.fna.fbcdn.net' alt='' class='circle'>
                    <span class='title'>Tatsuya ♥</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>5.01
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='https://instagram.fcgh11-1.fna.fbcdn.net/vp/3b8ed41235bcb2553392a35b75672d35/5DD9AD6C/t51.2885-15/e35/66657108_148711989558252_9147901568124242713_n.jpg?_nc_ht=instagram.fcgh11-1.fna.fbcdn.net' alt='' class='circle'>
                    <span class='title'>Daniel Oliveira</span>
                    <p><i class='material-icons tiny yellow-text'>grade</i>4.97
                    </p>
                </li>

                <li class='collection-item avatar'>
                    <img src='https://instagram.faep3-1.fna.fbcdn.net/vp/555cd2f07be894f73fd54d6c13df2649/5D8BC2D4/t51.2885-19/s150x150/57506563_326204114734809_8641339389118513152_n.jpg?_nc_ht=instagram.faep3-1.fna.fbcdn.net' alt='' class='circle'>
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

        $userIdAuth = $authenticate->getID();
        $announcement = new announcement();
        $announcement->showsAnnouncement($userIdAuth);

        ?>

    </div>

    <div class='col s2 hide-on-med-and-down'>
        <div class='card blue lighten-3'>
            <div class='card-content black-text´blue lighten-3'>
                <span class='card-title center h6'>publicidade</span>
                <span class='h3'> AUMENTO PENIANO E BLBABLABALBALBA </span>
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