<?php

require_once("../php/main.php");

session_start();

if (!isset($_SESSION["id"]) OR $_SESSION["rol"] == 0){
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
		<div class="landing">
			<div class="izquierda">
				<h1>CREAR PUBLICACION</h1>
				<form class="registro formulario" action="../php/subir_video.php" method="POST" enctype="multipart/form-data">
					<div class="grupo">
						<select name="curso" class="dato" required autocomplete="off">
							<option disabled selected></option>
							<?php
							$profesor = $_SESSION["id"];
							$cursos=conexion();
							$cursos=$cursos->query("SELECT * FROM Cursos WHERE profesor=$profesor");
							if($cursos->rowCount()>0){
								$cursos=$cursos->fetchAll();
								foreach($cursos as $registro){
									echo '<option value="'.$registro['id'].'" >'.$registro['nombre'].'</option>';
								}
							}
							$cursos=null;
							?>
						</select>
						<label class="placeholder">Publicar en el curso</label>
						<i class="fa-solid fa-angle-down"></i>
					</div>
					<div class="grupo">
						<label class="entrada dato">
							<span class="input">Video</span>
							<span class="borde">Formato MP4 (MAX 500MB).</span>
							<input id="archivo" type="file" name="video" accept=".mp4" hidden>
						</label>
					</div>
					<div class="grupo doble alto">
						<textarea type="text" name="descripcion_video" class="dato alto" required autocomplete="off" maxlength="512" minlength="10"></textarea>
						<label class="placeholder">Descripción del video</label>
					</div>
						<input id="enviar" class="desactivado video" type="submit" value="Subir video" disabled> 
						<i id="icono" class="fa-solid fa-cloud-arrow-up iconodes"></i>
				</form>
			</div>
			<div class="derecha">
				<img src="../images/videos.png">
			</div>
			<div class="respuesta">
			</div>
		</div>
	</main>
	<script type="text/javascript">
		let archivo = document.getElementById("archivo");
		let enviar = document.getElementById("enviar");
		let formulario = document.querySelector(".formulario");
		let icono = document.getElementById("icono");

		archivo.addEventListener("change", e => {
			if (e.target.files[0]){
				enviar.removeAttribute("disabled");
				enviar.classList.remove("desactivado");
				icono.classList.remove("iconodes");
			}
			else{
				enviar.classList.add("desactivado");
				enviar.setAttribute("disabled", "disabled");
				icono.classList.add("iconodes");
			}
		});
		formulario.addEventListener("submit",() => {
			enviar.classList.add("desactivado");
			enviar.setAttribute("disabled", "disabled");
			icono.className = "";
			icono.classList.add("fa-solid");
			icono.classList.add("fa-spinner");
			icono.classList.add("fa-spin");
		});
	</script>
</body>
</html>