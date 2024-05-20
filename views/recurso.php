<?php

require_once("../php/main.php");

session_start();

$curso_id = limpiar_cadena($_GET["curso"]);
$estudiante = $_SESSION["id"];

if (!isset($_GET["curso"]) OR !isset($_SESSION["id"])){
	header("Location: ./curso.php?curso=$curso_id");
}

$verificar_inscripcion = conexion();
$verificar_inscripcion = $verificar_inscripcion->query("SELECT id FROM Cursos_inscritos WHERE Usuarios_id = $estudiante AND Cursos_id = $curso_id");

if ($verificar_inscripcion->rowCount() == 0){
	header("Location: ./curso.php?curso=$curso_id");
}



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
		<?php require_once("../inc/busqueda.php"); ?>
		<nav>
			<ul>
				<li><a href="./cursos.php">MIS CURSOS</a></li>
				<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
				<div class="menu">
					<h4><img class="mano" src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
					<a href="./logout.php">Cerrar sesión</a>
				</div>
			</ul>
		</nav>
	</header>
	<main>
		<section class="landing descripcion">
			<div class="izquierda">
				<button class="este"><i class="fa-solid fa-chevron-left"></i></button>
				<button class="oeste desactivado" disabled><i class="fa-solid fa-chevron-right"></i></button>
				<video controls autoplay>
					<source src="../videos/React_desde_cero_234_1.mp4" type="video/mp4">
				</video>
				<h2 class="titulo">React desde cero</h2>
				<div class="profesor">
					<img src="../photos/ProgramacionFacil_153.jpg">
					<p>ProgramacionFacil</p>
				</div>
			</div>
			<div class="derecha">
				<div class="texto">
					<div>
						<h4>0 vistas <i class="fa-regular fa-eye"></i></i></h4>
						<h5>2024-05-19 <i class="fa-regular fa-calendar-days"></i></h4>
						</div>
						<p>Este curso está diseñado para desarrolladores que desean aprender a construir aplicaciones web modernas y dinámicas utilizando React, una de las bibliotecas de JavaScript más populares y potentes para la creación de interfaces de usuario. A lo largo del curso, los participantes adquirirán una comprensión profunda de los conceptos fundamentales de React, así como las mejores prácticas para desarrollar aplicaciones escalables y mantenibles.</p>
					</div>
				</div>
		</section>
		<div class="respuesta">
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var video = document.getElementsByTagName('video')[0];
				var ultimo_tiempo = 0;
				var boton = document.querySelector(".oeste");


				video.addEventListener('timeupdate', function() {
					if (video.currentTime > ultimo_tiempo + 0.6) {
						video.currentTime = ultimo_tiempo;
					} else {
						ultimo_tiempo = video.currentTime;
					}

					if (video.currentTime > video.duration * 0.9){
						boton.removeAttribute("disabled");
						boton.classList.remove("desactivado");
					}
					else{
						boton.classList.add("desactivado");
						boton.setAttribute("disabled", "disabled");
					}
				});

				video.addEventListener('seeking', function() {
					if (video.currentTime > ultimo_tiempo) {
						video.currentTime = ultimo_tiempo;
					}
				});
			});
		</script>
	</main>
</body>
</html>