<?php session_start(); ?>

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
					<li class="cuenta"><a href="./views/cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
					<div class="menu">
						<h4><img src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif" width="24"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
						<a href="./views/logout.php">Cerrar sesion</a>
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
			<div class="izquierda">
				<h1>APRENDE, DESCUBRE Y SUPERATE</h1>
				<h4>La nueva plataforma de aprendizaje digital</h4>
				<a href="" class="boton_pa_juan">
					<i></i>
					<i></i>
					<span>Explorar</span>
				</a>
			</div>
			<div class="derecha">
				<img src="./images/persona.png">
			</div>
		</section>
	</main>
	<script type="text/javascript">
		let btn = document.getElementsByClassName("boton_pa_juan")[0];
		btn.addEventListener("mousemove", e => {
			let rect = e.target.getBoundingClientRect();
			let x = e.clientX * 2 - rect.left;
			btn.style.setProperty("--x", x + "deg");
		});
	</script>
</body>
</html>