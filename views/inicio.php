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
		</a>
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
				<h1>BIENVENIDO/A DE NUEVO</h1>
				<form class="registro" action="" method="POST">
					<div class="grupo doble">
						<input type="text" name="login_usuario" class="dato mover_dato" required autocomplete="off" maxlength="45" minlength="4">
						<label class="placeholder mover">Correo Electrónico o Nombre de Usuario</label>
						<i class="fa-solid fa-envelope iconos"></i>
					</div>
					<div class="grupo doble">
						<input type="password" id="contra" name="login_contrasena" class="dato mover_dato" required autocomplete="off" pattern="[a-zA-Z0-9$@.-]{8,24}" maxlength="20" minlength="8">
						<label class="placeholder mover">Contraseña</label>
						<i class="fa-regular fa-eye" id="ojo"></i>
						<i class="fa-solid fa-lock iconos"></i>
					</div>
					<p><a href="./recuperar.php">¿Olvidaste tu contraseña?</a></p>
					<input type="submit" name="" value="Ingresar">
				</form>
			</div>
			<div class="derecha">
				<img src="../images/inicio.png">
			</div>
			<div class="respuesta">
				<?php

				if (isset($_POST["login_usuario"]) && isset($_POST["login_contrasena"])){
					require_once("../php/main.php");
					require_once("../php/iniciar_sesion.php");
				}

				?>
			</div>
		</div>
	</main>
</body>
</html>