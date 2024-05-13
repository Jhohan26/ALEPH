<?php

session_start();

if (isset($_SESSION["id"])){
	if (headers_sent()){
		echo ("<script>window.location.href='../index.php'</script>");
	}
	else{
		header("Location: ../index.php");
	}
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
		<a>
		<nav>
			<ul>
				<li><a href="../index.php">SOBRE ALEPH</a></li>
				<li><a href="./registro.php">REGISTRARSE</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="landing">
			<div class="izquierda">
				<h1>RECUPERAR CLAVE</h1>
				<form class="registro formulario" action="../php/cambio.php" method="POST">
					<div class="grupo doble">
						<input type="text" name="correo" class="dato mover_dato" required autocomplete="off" maxlength="45" minlength="4">
						<label class="placeholder mover">Correo Electrónico</label>
						<i class="fa-solid fa-envelope iconos"></i>
					</div>
					<div class="grupo">
						<input type="password" id="contra" name="primera_contrasena" class="dato mover_dato" required autocomplete="off" pattern="[a-zA-Z0-9$@.-]{8,24}" maxlength="20" minlength="8">
						<label class="placeholder mover">Nueva Contraseña</label>
						<i class="fa-regular fa-eye" id="ojo"></i>
						<i class="fa-solid fa-lock iconos"></i>
					</div>
					<div class="grupo">
						<input type="password" id="contra" name="segunda_contrasena" class="dato mover_dato" required autocomplete="off" pattern="[a-zA-Z0-9$@.-]{8,24}" maxlength="20" minlength="8">
						<label class="placeholder mover">Confirmar Contraseña</label>
						<i class="fa-regular fa-eye" id="ojo"></i>
						<i class="fa-solid fa-lock iconos"></i>
					</div>
					<p style="opacity: 0;">Entre 8 y 24 caracteres</p>
					<input type="submit" name="" value="Cambiar">
				</form>
			</div>
			<div class="derecha">
				<img src="../images/contrasena.png">
			</div>
			<div class="respuesta">
			</div>
		</div>
	</main>
</body>
</html>