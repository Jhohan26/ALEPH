<?php session_start();

if (substr_count($_SERVER["REQUEST_URI"], "/") >= 3){

?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once("../inc/head.php"); ?>
</head>
<body>
	<header>
		<a class="logo" href="../index.php">
			<img src="../logos/blanco.svg">
			<h2 class="texto_logo">ALEPH</h2>
		</a>
		<form class="busqueda" method="GET">
			<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off">
			<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<nav>
			<ul>
				<?php 

				if (isset($_SESSION["id"])){
				?>
					<li><a href="./inicio.php">MIS CURSOS</a></li>
					<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
					<div class="menu">
						<h4><img src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
						<a href="./logout.php">Cerrar sesión</a>
					</div>

				<?php }else{ ?>

					<li><a href="./inicio.php">INICIAR SESION</a></li>
					<li><a href="./registro.php">REGISTRARSE</a></li>

				<?php } ?>

			</ul>
		</nav>
	</header>
	<main>
		<section class="landing">
			<div class="page404">
				<h1>404</h1>
				<h2>PAGE NOT FOUND</h2>
			</div>
		</section>
	</main>
</body>
</html>

<?php }else{ ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	<title>ALEPH | cursos</title>
	<script src="https://kit.fontawesome.com/b48cdd04ea.js" crossorigin="anonymous"></script>
	<link rel="icon" href="./icon.avif">
</head>
<body>
	<header>
		<a class="logo" href="./index.php">
			<img src="./logos/blanco.svg">
			<h2 class="texto_logo">ALEPH</h2>
		<a>
		<form class="busqueda" method="GET">
			<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off">
			<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<nav>
			<ul>
				<?php 

				if (isset($_SESSION["id"])){
				?>
					<li><a href="./views/inicio.php">MIS CURSOS</a></li>
					<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
					<div class="menu">
						<h4><img class="mano" src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
						<a href="./views/logout.php">Cerrar sesión</a>
					</div>

				<?php }else{ ?>

					<li><a href="./views/inicio.php">INICIAR SESION</a></li>
					<li><a href="./views/registro.php">REGISTRARSE</a></li>

				<?php } ?>

			</ul>
		</nav>
	</header>
	<main>
		<section class="landing">
			<div class="page404">
				<h1>404</h1>
				<h2>PAGE NOT FOUND</h2>
			</div>
		</section>
	</main>
</body>
</html>

<?php } ?>