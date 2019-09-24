<?php
require 'header.php';
require 'class/authenticate.class.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3 card-panel">
        <h5 class="light left-align col s12 grey-text text-darken-3">Login</h5>
        <form action="loggingIn.php" method="POST">

            <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input type="text" name="email" id="email">
                <label for="email">E-mail</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">https</i>
                <input type="password" name="password" id="password">
                <label for="password">Senha</label>
                <span class="helper-text grey-text text-darken-3"><a href="">Esqueci minha senha</span>
            </div>

            <div class="row col s12">

                <button type="submit" name="btn" class="btn grey darken-3 hoverable blue-text text-lighten-4">
                    Entrar
                </button>

                <a href="register.php" class="btn blue lighten-4 hoverable black-text">
                    Registrar
                </a>

            </div>

        </form>
    </div>
</div>

<center>
    <?php
    session_start();

    echo @$_SESSION['fastLogin'];
    echo @$_SESSION['notice'];

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];

        foreach ($error as $erro) { ?>
            <div class="chip grey darken-3 blue-text text-lighten-4">
                <?php echo $erro; ?>
                <i class="close material-icons white-text">close</i>
            </div><?php
                        }
                    }

                    unset($_SESSION['error'], $_SESSION['notice'], $error, $erro);
                    ?>
</center><br>

<footer class="page-footer blue lighten-3 grey-text text-darken-4">
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

</body>

</html>