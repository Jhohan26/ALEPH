<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	<title>ALEPH | cursos</title>
	<script src="https://kit.fontawesome.com/b48cdd04ea.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/scroll.js" defer></script>
	<script type="text/javascript" src="./js/carrusel.js" defer></script>
	<link rel="icon" href="./icon.avif">
</head>
<body>
	<header>
		<a class="logo" href="./index.php">
			<img src="./logos/blanco.svg">
			<h2 class="texto_logo">ALEPH</h2>
		<a>
		<form class="busqueda" method="GET" action="./views/catalogo.php">
			<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off">
			<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<nav>
			<ul>
				<?php 

				if (isset($_SESSION["id"])){
				?>
					<li><a href="./views/cursos.php">MIS CURSOS</a></li>
					<li class="cuenta"><a href="./views/cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
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
			<div class="izquierda">
				<h1>APRENDE, DESCUBRE Y SUPERATE</h1>
				<h4>La nueva plataforma de aprendizaje digital</h4>
				<a href="./views/catalogo.php" class="boton_pa_juan">
					<i></i>
					<i></i>
					<span>Explorar</span>
				</a>
			</div>
			<div class="derecha">
				<img src="./images/persona.png">
			</div>
		</section>
		<section class="sobre">
			<div class="izquierda">
				<div class="imagenes">
					<img class="grande" src="./images/sobre.png">
					<img class="pequeno i1" src="./images/persona1.png">
					<img class="pequeno i2" src="./images/persona2.png">
					<img class="pequeno i3" src="./images/persona3.png">
				</div>
			</div>
			<div class="derecha">
				<h2>SOBRE ALEPH</h2>
				<p>
					<b>Aleph</b> es una plataforma educativa gratuita diseñada para que todos, sin
					importar su edad, experiencia o ubicación, tengan acceso a herramientas y
					recursos de aprendizaje de alta calidad.
				</p>
			</div>
		</section>
		<section class="servicios">
			<div class="izquierda">
				<h2>Que ofrecemos</h2>
				<div class="carrusel">
					<button class="este"><i class="fa-solid fa-chevron-left"></i></button>
					<button class="oeste"><i class="fa-solid fa-chevron-right"></i></button>
					<div class="todo mover_js0">
					<div class="slider">
						<img src="./images/slider1.png">
						<h3>Aprender a tu propio ritmo</h3>
						<p>Elige entre una amplia variedad de cursos, desde habilidades básicas hasta temas especializados, con videos interactivos.</p>
					</div>
					<div class="slider">
						<img src="./images/slider2.png">
						<h3>Desarrollar nuevas habilidades</h3>
						<p>Aprende a programar, diseñar, crear contenido multimedia, dominar idiomas, emprender tu propio negocio ¡y mucho más!.</p>
					</div>
					<div class="slider">
						<img src="./images/slider3.png">
						<h3>Explorar tus intereses</h3>
						<p>Aprende a programar, diseñar, crear contenido multimedia, dominar idiomas, emprender tu propio negocio ¡y mucho más!.</p>
					</div>
					</div>
				</div>
			</div>
			<div class="derecha">
				<img src="./images/servicios.png">
			</div>
		</section>
	</main>
	<footer>
		<ul>
			<li class="instagram">
				<a target="_blank" rel="noopener noreferrer"><div class="redes"><i class="fa-brands fa-instagram"></i></div></a>
			</li>
			<li class="facebook">
				<a target="_blank" rel="noopener noreferrer"><div class="redes"><i class="fa-brands fa-facebook-f"></i></div></a>
			</li>
			<li class="whatsapp">
				<a target="_blank" rel="noopener noreferrer"><div class="redes"><i class="fa-brands fa-whatsapp"></i></div></a>
			</li>
		</ul>
		<p>Copyrigth &copy; 2024 Aleph</p>
		<div class="scroll">
			<ul class="elementos texto">
				<?php

				for ($i=0; $i < 24; $i++){
					echo("<li>ALEPH </li");
				}

				?>
			</ul>
		</div>
	</footer>
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