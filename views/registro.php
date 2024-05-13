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
				<li><a href="./inicio.php">INICIAR SESION</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="landing">
			<div class="izquierda">
				<h1>REGISTRATE</h1>
				<h4>Aprende a tu propio ritmo con nosotros</h4>
				<form class="registro formulario" method="POST" action="../php/registrar.php">
					<div class="grupo">
						<input type="text" name="primer_nombre" class="dato" required autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}" maxlength="20", min="3">
						<label class="placeholder">Primer Nombre<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="segundo_nombre" class="dato" autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}" maxlength="20", min="0">
						<label class="placeholder">Segundo Nombre</label>
					</div>
					<div class="grupo">
						<input type="text" name="primer_apellido" class="dato" required autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}" maxlength="20", min="3">
						<label class="placeholder">Primer Apellido<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="segundo_apellido" class="dato" autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}" maxlength="20", min="0">
						<label class="placeholder">Segundo Apellido</label>
					</div>
					<div class="grupo">
						<input type="email" name="correo" class="dato" required autocomplete="off" maxlength="45">
						<label class="placeholder">Correo Electrónico<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="usuario" class="dato" required autocomplete="off" pattern="[a-zA-Z0-9]{4,20}" maxlength="20", min="4">
						<label class="placeholder">Nombre de Usuario<span>*</span></label>
					</div>
					<div class="grupo doble">
						<input type="password" id="contra" name="contrasena" class="dato" required autocomplete="off" pattern="[a-zA-Z0-9$@.-]{8,24}" maxlength="20", min="8">
						<label class="placeholder">Contraseña<span>*</span></label>
						<i class="fa-regular fa-eye" id="ojo"></i>
					</div>
					<p>Entre 8 y 24 caracteres</p>
					<input type="submit" name="" value="Registrar">
				</form>
			</div>
			<div class="derecha">
				<img src="../images/registro.png">
			</div>
		</div>
		<div class="respuesta">
		</div>
	</main>
</body>
</html>