<?php
require 'class/Authenticate.class.php';
require 'class/AccountLogin.class.php';
require 'class/Announcement.class.php';

$authenticate = new Authenticate($_COOKIE['token']);
$codUser = $authenticate->getId();

$showing = new AccountLogin();

$showing->accountShowing($_GET['id'], $codUser);
?>

<!DOCTYPE html>
<html>

<head>

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

	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

	<link type='text/css' rel='stylesheet' href='../css/style.css'>

	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<link type='image/png' rel='icon' href='../handshake.png'>
	<meta charset='UTF-8'>

	<title>Fast Jobs</title>

</head>

<script type='text/javascript'>
	function change_placeholder_color(target_class, color_choice) {
		$("body").append("<style>" + target_class + "::placeholder{color:" + color_choice + "}</style>")
	}

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
			$('.colorText').animate({
				'color': 'white'
			});
			change_placeholder_color('.colorTextplace', 'white');
		} else {
			$('.colorText').animate({
				'color': 'black'
			});
			change_placeholder_color('.colorTextPlace', 'black');
		}

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

<body>

	<div id="candidatos35" class="modal bottom-sheet">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>

	<nav class=''>
		<div class='nav-wrapper colorBack' style='background:#90caf9'>
			<a href='' class='brand-logo light center colorText'>FAST JOBS</a>
		</div>
	</nav>

	<div class="tap-target colorBack colorText" data-target="backbutton">
		<div class="tap-target-content">
			<h5>Olá</h5>
			<p>Use este botão para voltar a home</p>
		</div>
	</div>

	<style>
		#search::-webkit-input-placeholder {
			color: #000;
			font-style: bold;
		}
	</style>

	<ul id='dropdown1' class='dropdown-content'>
		<li><a href='../profile.php' class='grey-text text-darken-3 disabled'>Meu Perfil</a></li>
		<li class='divider'></li>
		<li><a href='../goingOut.php' class='red-text text-lighten-1'>Encerar Sessão</a></li>
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
				<div class='card-content'>
					<span class='card-title colorText'>Melhores Usuários <span class='right'>:)</span></span>

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
						<div class='nav-wrapper colorBack' style='background:#90caf9'>
							<form>
								<div class='input-field'>
									<input class="colorTextPlace" id='search' type='search' placeholder='Pesquisar Usuário' required>
									<label class='label-icon' for='search'><i class='material-icons colorText'>search</i>Pesquisar Usuário</label>
									<i class='material-icons'>close</i>
								</div>
							</form>
						</div>
					</nav>
				</ul>
			</div>
		</div>

		<div class='col s7'>

			<?php
			if ($showing->getUserFound()) {
				?>

				<div class='card-panel col s12 colorBack' style='background:#90caf9'><br>
					<div class='center'><img id='imagem' src='../<?php echo $showing->getPhoto(); ?>' class='circle z-depth-5' height='200' width='200'></div>
					<div class='card z-depth-5'><br>
						<h4 class='light center'> <?php echo $showing->getName(); ?> </h4><br>
						<h6 class='light center col s6'> <?php echo $showing->getEmail(); ?> </h6>
						<h6 class='light center col s6'> <?php echo $showing->getTelephone(); ?> </h6><br><br><br>
					</div>
				</div>

			<?php
			} else {
				?>

				<div class='card-panel col s12 colorBack' style='background:#90caf9'><br>
					<div class='center'><img id='imagem' src='../users/photos/Person.jpg' class='circle z-depth-5' height='200' width='200'></div>
					<div class='card z-depth-5'><br>
						<h4 class='light center'>Usuário não encontrado</h4><br>
					</div>
				</div>

			<?php
			}
			?>

			<!-- <div class='card col s12'>
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
                            <button class='btn white right black-text' type='submit'>Criar anúncio<i class='left material-icons tiny  colorColor'>create</i></a><br><br>
                        </div>

                        <div class="input-field col s4 hide">
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
                        </div>

                    </form>

                </div>
            </div> -->

			<?php

			$announcement = new announcement();
			$announcement->showsannouncementUser($_GET['id'], $codUser);

			?>

		</div>

		<div class='col s2 hide-on-med-and-down right'>
			<div class='card'>
				<div class='card-content colorBack colorText' style='background:#90caf9'>
					<span class='card-title center h6'> </span>
					<span class='h3'> </span>
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
		<a href='../home.php' class='btn-floating btn-large colorBack' id='backbutton' style='background:#ef9a9a'>
			<i class='large material-icons colorText'>arrow_back</i>
		</a>
	</div>
	<footer style='background:#90caf9' class='page-footer footer colorBack colorText'>
		<div class='container'>
			<div class='row'>
				<div class='col s12'>
					<h5 class='light'>FAST JOBS</h5>
					<p class=''> Criado e mantido por BlueCODE|</p>
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

		localStorage.setItem('viewed', 'TRUE');
	</script>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
	<script src='https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>

</body>

</html>