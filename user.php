<?php
require 'class/authenticate.class.php';
require 'class/accountRegister.class.php';
require 'class/announcement.class.php';

$authenticate = new authenticate($_COOKIE['token']);

$showing = new accountRegister();

$showing->accountShowing($_GET['id']);
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

	<script src="../node_modules/colorthief/dist/color-thief.umd.js"></script>

	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js'></script>

	<link type='text/css' rel='stylesheet' href='../css/style.css'>

	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<link type='image/png' rel='icon' href='../handshake.png'>
	<meta charset='UTF-8'>

	<title>Fast Jobs</title>

</head>

<body>

	<div id='edit' class='modal'>
		<div class='modal-content'>
			<h4>Perfil</h4>

		</div>
		<div class='modal-footer'>
			<a href='#!' class='modal-close btn-flat'>Fechar</a>
			<button href='#!' type='submit' class='btn-flat'>Salvar</a>
		</div>
	</div>

	<div id="candidatos35" class="modal bottom-sheet">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>

	<script type='text/javascript'>
		window.onload = function() {
			var colorThief = new ColorThief();
			var color = colorThief.getColor(document.getElementById('imagem'));
			color = ('rgb(' + color + ')');

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

	<nav class=''>
		<div class='nav-wrapper colorBack' style='background:#90caf9'>
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
				<div class='center'><img id='imagem' src='../users/photos/comia.jpg' class='circle z-depth-5' height='200' width='200'></div>
				<div class='card z-depth-5'><br>
					<h4 class='light center'> <?php echo $showing->getName(); ?> </h4><br>
					<h6 class='light center col s6'> <?php echo $showing->getEmail(); ?> </h6>
					<h6 class='light center col s6'> <?php echo $showing->getTelephone(); ?> </h6><br><br><br>
				</div>
			</div>

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
			$announcement->showsannouncementUser($_GET['id']);

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
		<a href='../home.php' class='btn-floating btn-large colorBack' id='backbutton' style='background:#ef9a9a'>
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

		$(document).ready(function() {
			$('.tap-target').tapTarget();
		});
	</script>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
	<script src='https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>

</body>

</html>