<?php session_start();

if (!isset($_SESSION["id"])){
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
		<form class="busqueda" method="GET">
			<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off">
			<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<nav>
			<ul>
				<li><a href="../index.php">SOBRE ALEPH</a></li>
				<li><a href="">MIS CURSOS</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section class="landing cuenta">
			<div class="izquierda">
				<div class="tarjeta">
					<img class="user" src="../photos/user.jpg">
					<h3>
						<?php
						echo($_SESSION["primer_nombre"]." ".$_SESSION["primer_apellido"]);
						?>
					</h3>
					<hr>
					<div class="info">
						<h5><img src="../logos/SoloBuhoAleph.svg">NOMBRE DE USUARIO:</h5>
						<p><?php echo($_SESSION["usuario"]); ?></p>
					</div>
					<div class="info">
						<h5><img src="../logos/SoloBuhoAleph.svg">NOMBRE COMPLETO:</h5>
						<p>
							<?php
							echo($_SESSION["primer_nombre"]." ".$_SESSION["segundo_nombre"]." ".$_SESSION["primer_apellido"]." ".$_SESSION["segundo_apellido"]);
							?>
						</p>
					</div>
					<div class="info">
						<h5><img src="../logos/SoloBuhoAleph.svg">CORREO ELECTRONICO:</h5>
						<p><?php echo($_SESSION["correo"]); ?></p>
					</div>
				</div>
			</div>
			<div class="derecha">
				<div class="tarjeta">
					<h3>LOGROS</h3>
					<h4>Por el momento no has terminado ninguno curso</h4>
				</div>
				<div class="tarjeta">
					<h3>PROGRESO</h3>
					<h4>No estas realizando ningun curso en el momento</h4>
				</div>
			</div>
		</section>
	</main>
</body>
</html>