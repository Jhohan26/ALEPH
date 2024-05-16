<?php

session_start();

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
		<nav>
			<ul>
				<li><a href="./cursos.php">MIS CURSOS</a></li>
				<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
				<div class="menu">
					<h4><img src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif" width="24"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
					<a href="./logout.php">Cerrar sesión</a>
				</div>
			</ul>
		</nav>
	</header>
	<main>
		<div class="landing">
			<div class="izquierda">
				<h1>ACTUALIZA TU FOTO</h1>
				<form class="registro formulario" action="../php/cambiar_foto.php" method="POST" enctype="multipart/form-data">
						<label class="entrada">
							<span class="input">Imagen</span>
							<span>JPG, JPEG, PNG. (MAX 3MB)</span>
							<input id="archivo" type="file" name="imagen" accept=".jpg, .png, .jpeg" hidden>
						</label>
						<input id="enviar" class="desactivado" type="submit" value="Actualizar" disabled>
				</form>
			</div>
			<div class="derecha">
				<img class="perfil" src="<?php

				$ruta = $_SESSION["foto"] != "" ? $_SESSION["foto"] : "user.jpg";
				$ruta = "../photos/".$ruta;

				echo($ruta);

				?>">
			</div>
			<div class="respuesta">
			</div>
		</div>
	</main>
	<script type="text/javascript">
		let archivo = document.getElementById("archivo");
		let enviar = document.getElementById("enviar");
		let imagen = document.querySelector(".perfil");

		archivo.addEventListener("change", e => {
			if (e.target.files[0]){
				const reader = new FileReader();
				reader.onload = function(e){
					imagen.src = e.target.result;
				}
				reader.readAsDataURL(e.target.files[0]);
				enviar.removeAttribute("disabled");
				enviar.classList.remove("desactivado");
			}
			else{
				enviar.classList.add("desactivado");
				enviar.setAttribute("disabled", "disabled");
			}
		});
	</script>
</body>
</html>