<?php
require 'class/authenticate.class.php';
require 'class/announcement.class.php';
$authenticate = new authenticate($_COOKIE['token']);

@session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <script>
        function lightOrDark(color) {

            // Variables for red, green, blue values
            var r, g, b, hsp;

            // Check the format of the color, HEX or RGB?
            if (color.match(/^rgb/)) {

                // If HEX --> store the red, green, blue values in separate variables
                color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);

                r = color[1];
                g = color[2];
                b = color[3];
            } else {

                // If RGB --> Convert it to HEX: http://gist.github.com/983661
                color = +("0x" + color.slice(1).replace(
                    color.length < 5 && /./g, '$&$&'));

                r = color >> 16;
                g = color >> 8 & 255;
                b = color & 255;
            }

            // HSP (Highly Sensitive Poo) equation from http://alienryderflex.com/hsp.html
            hsp = Math.sqrt(
                0.299 * (r * r) +
                0.587 * (g * g) +
                0.114 * (b * b)
            );

            // Using the HSP value, determine whether the color is light or dark
            if (hsp > 127.5) {

                return 'light';
            } else {

                return 'dark';
            }
        }
    </script>

    <style>
        .input-field input:focus+label {
            color: #000 !important;
        }

        .row .input-field input:focus {
            border-bottom: 1px solid #000 !important;
            box-shadow: 0 1px 0 0 #000 !important
        }

        .material-icons.active {
            color: #90caf9 !important;
        }
    </style>

    <script src="node_modules/colorthief/dist/color-thief.umd.js"></script>

    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js'></script>

    <link type='text/css' rel='stylesheet' href='css/style.css'>

    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <link type='image/png' rel='icon' href='handshake.png'>
    <meta charset='UTF-8'>

    <title>Fast Jobs</title>

</head>

<body>

    <div id='edit' class='modal'>
        <div class='modal-content'>
            <form method="post" action="updatingAccount.php" enctype="multipart/form-data">
                <h4>Perfil</h4>

                <div class='input-field col s612'>
                    <!-- <i class="material-icons prefix">person</i>
                    <input id='name' type='text' class='profile' name='name'> -->
                    <!-- <label for='name' class='profile'>Nome</label> -->
                </div>

                <div class="file-field input-field">
                    <div class="btn colorBack black-text">
                        <span>Foto de perfil</span>
                        <input name="photo" type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Somente arquivos JPG/PNG/BMP">
                    </div>
                </div>

        </div>
        <div class='modal-footer'>
            <a href='#!' class='modal-close btn-flat'>Fechar</a>
            <button type='submit' class='btn-flat'>Salvar</a>
                </form>
        </div>
    </div>

    <script type='text/javascript'>
        window.onload = function() {
            <?php if (@$_SESSION['announcement'] != '') { ?>
                M.toast({
                    html: '<?php echo $_SESSION['announcement'] ?>'
                });
            <?php } ?>

            var colorThief = new ColorThief();
            var color = colorThief.getColor(document.getElementById('imagem'));
            color = ('rgb(' + color + ')');

            if (lightOrDark(color) == 'dark') {
                // $('.colorText').animate({'color': 'white'});
                console.log('kkkkkkkk');
                $('#nav').css({
                    'color': 'red'
                });
                
            }
            console.log(color);

            $('.colorBack').animate({
                backgroundColor: color
            })
            $('colorColor').animate({
                color: color
            })
            $('.tap-target').tapTarget('open')
        };
    </script>
    <?php session_unset();
    ?>

    <nav class='' id='nav'>
        <div class='nav-wrapper colorBack colorText' style='background:#90caf9'>
            <a href='' class='brand-logo light center grey-text text-darken-3'>FAST JOBS</a>
        </div>
    </nav>

    <div class="tap-target colorBack" data-target="backbutton">
        <div class="tap-target-content">
            <h5>Caralho parcero</h5>
            <p>que volta? so clica nessa porra</p>
        </div>
    </div>

    <style>
        #search::-webkit-input-placeholder {
            color: #000;
            font-style: bold;
        }
    </style>

    <ul id='dropdown1' class='dropdown-content'>
        <li><a href='profile.php' class='grey-text text-darken-3 disabled'>Meu Perfil</a></li>
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
            <div class='card hoverable colorBack' style='background:#90caf9'>
                <div class='card-content black-text'>
                    <span class='card-title'>Melhores Usuários <span class='right'>:)</span></span>

                </div>
                <ul class='collection'>

                    <li class='collection-item avatar'>
                        <img src='https://instagram.fcgh11-1.fna.fbcdn.net/vp/fe6aa5337b36bce7ae8e417d65b600d8/5E05F285/t51.2885-19/s150x150/67727803_408078650067138_1975367184414670848_n.jpg?_nc_ht=instagram.fcgh11-1.fna.fbcdn.net' alt='' class='circle'>
                        <span class='title'>Cintia Barbosa</span>
                        <p><i class='material-icons tiny yellow-text'>grade</i>5.01
                        </p>
                    </li>

                    <li class='collection-item avatar'>
                        <img src='https://instagram.fcgh11-1.fna.fbcdn.net/vp/79ce45847126e1776511183de150d650/5E050D07/t51.2885-19/s150x150/66673162_373444230236014_7726763035859091456_n.jpg?_nc_ht=instagram.fcgh11-1.fna.fbcdn.net' alt='' class='circle'>
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
                        <div class='nav-wrapper colorBack' style='background:#90caf9'>
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

            <div class='card-panel col s12 colorBack' style='background:#90caf9'><br>
                <div class='center'><img id='imagem' src='<?php echo $authenticate->getPhoto(); ?>' class='circle z-depth-5' height='200' width='200'></div>
                <div class='card'><br>
                    <h4 class='light center'> <?php echo $authenticate->getUser(); ?> </h4><br>
                    <h6 class='light center col s6'> <?php echo $authenticate->getEmail(); ?> </h6>
                    <h6 class='light center col s6'> <?php echo $authenticate->getTelephone(); ?> </h6><br><br><br>
                </div>

                <a href='#edit' class='btn white right black-text modal-trigger'>Editar Perfil<i class='left material-icons tiny colorCoBack'>edit</i></a><br><br>
            </div>

            <div class='card col s12'>
                <div class='card-content black-text'>
                    <span class='card-title'>Criar anúncio</span>
                    <form action='creatingAnnouncement.php' method='POST'>

                        <div class='input-field col s6'>
                            <input id='title' type='text' class='profile' name='title'>
                            <label for='title' class='profile'>Título anúncio</label>
                        </div>

                        <div class='input-field col s4'>
                            <input id='address' class='profile' type='text' name='address'>
                            <label for='address' class='profile'>Local do trabalho</label>
                        </div>

                        <div class='input-field col s2'>
                            <input id='payment' class='profile' type='text' name='payment'>
                            <label for='payment' class='profile'>Pagamento</label>
                        </div>

                        <div class='input-field col s12 profile'>
                            <input id='description' type='text' class='profile' name='description'>
                            <label for='description' class='profile'>Descrição do trabalho</label>
                            <button class='btn white right black-text' type='submit'>Criar anúncio<i class='left material-icons tiny colorColor'>create</i></a><br><br>
                        </div>

                        <!-- <div class="input-field col s4">
                            <select>
                                <optgroup label="Reforma">
                                    <option value="1">Pedreiro</option>
                                    <option value="2">Vidraceiro</option>
                                <optgroup label="Assistencia">
                                    <option value="3">Eletronicos</option>
                                    <option value="4">Eletrodomesticos</option>
                                <optgroup label="mecanica">
                                    <option value="5">Carros/ motos</option>
                                    <option value="6">Outros</option>
                            </select>
                            <label>Tipo de empregado</label>
                            <button class='btn white right black-text' type='submit'>Criar anúncio<i class='left material-icons tiny' id='creatingAd'>create</i></a><br><br>
                        </div> -->

                    </form>

                </div>
            </div>

            <?php

            $codUser = $authenticate->getId();
            $announcement = new announcement();
            $announcement->showsannouncementProfile($codUser);

            ?>

        </div>

        <div class='col s2 hide-on-med-and-down right'>
            <div class='card'>
                <div class='card-content black-text colorBack' style='background:#90caf9'>
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

    <div class='fixed-action-btn right'>
        <a href='home.php' class='btn-floating btn-large colorBack' id='backbutton' style='background:#ef9a9a'>
            <i class='large material-icons black-text'>arrow_back</i>
        </a>
    </div>
    <footer style='background:#90caf9' class='page-footer grey-text text-darken-4 footer colorBack'>
        <div class='container'>
            <div class='row'>
                <div class='col s12'>
                    <h5 class='light'>FAST JOBS</h5>
                    <p class=''>Created and maintained by BlueCODE|</p>
                </div>
            </div>
        </div>
        <div class='footer-copyright black-text'>
            <div class='container'>

            </div>
        </div>
    </footer>

    <script>
        $('.dropdown-trigger').dropdown();

        $(document).ready(function() {
            $('#payment').mask('000.000.000,00', {
                reverse: true
            });
        });

        $(document).ready(function() {
            $('.modal').modal();
        });

        $('.chips-placeholder').chips({
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
        });

        $(document).ready(function() {
            $('select').formSelect();
        });

        if (!localStorage.getItem('viewed')) {
            $(document).ready(function() {
                $('.tap-target').tapTarget();
            });
        }

        // if (localStorage.getItem('photoChanged')){
        //     alert('kkkkktrouxa');
        //     localStorage.removeItem('photoChanged');
        // }

        localStorage.setItem('viewed', 'TRUE');
    </script>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
    <script src='https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>

</body>

</html>