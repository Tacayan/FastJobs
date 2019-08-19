<?php
    require 'header.php';
    require 'class/accountRegister.class.php';
?>

    <div class="row">
    <div class="col s12 m6 push-m3 card-panel">
        <h5 class="light left-align col s12 grey-text text-darken-3">Registro</h5>
        <form action="registration.php" method="POST">

            <div class="input-field col s6">
                <i class="material-icons prefix">assignment_ind</i>
                <input type="text" name="name" id="name">
                <label for="name">Nome</label>
            </div>
            
            <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input type="text" name="email" id="email">
                <label for="email">E-mail</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">https</i>
                <input type="password" name="password" id="password">
                <label for="password">Senha</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">https</i>
                <input type="password" name="password2" id="password2">
                <label for="password2">Confirme sua senha</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">description</i>
                <!-- <input type="text" name="cpf" id="cpf"> -->
                <label for="cpf">CPF</label><span class="red-text helper-text">Disabilitado ;)</span>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">call</i>
                <input type="text" name="telephone" id="telephone">
                <label for="telephone">Telefone</label>
            </div>

            <div class="row col s12">

                <button type="submit" name="btn" class="btn grey darken-3 hoverable blue-text text-lighten-4">
                    Registrar
                </button>

                <a href="index.php" class="btn blue lighten-4 hoverable black-text">
                    Voltar
                </a>

            </div>

        </form>
    </div>
</div>

<center>
<?php
    session_start();

    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];

        foreach($error as $erro){ ?>
            <div class="chip grey darken-3 blue-text text-lighten-4">
            <?php echo $erro; ?>
            <i class="close material-icons white-text">close</i>
        </div><?php
        }
    }

    unset($_SESSION['error'], $error, $erro);
?>
</center><br>

<footer class="page-footer blue lighten-3 grey-text text-darken-4 footer">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="light">FAST JOBS</h5>
                <p class="">Criado e mantido por BlueCODE|</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright black-text">
        <div class="container">

        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

    <script>
    $(document).ready(function () { 
        $("#cpf").mask('000.000.000-00');
        $("#telephone").mask('(00) 00000-0000');
    });
    </script>

    </body>
  </html>