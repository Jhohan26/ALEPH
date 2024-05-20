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
		</a>
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
			<div class="derecha">
				<img src="../images/crear.png">
			</div>
			<div class="izquierda diferente">
				<h1>CREA TU CURSO</h1>
				<form class="registro formulario" method="POST" enctype="multipart/form-data" action="../php/nuevo_curso.php">
					<div class="grupo">
						<input type="text" name="nombre_curso" class="dato" required autocomplete="off" maxlength="45" minlength="4">
						<label class="placeholder">Nombre del curso</label>
					</div>
					<div class="grupo">
						<select name="categoria" class="dato" required autocomplete="off">
							<option disabled selected></option>
							<?php
							$categorias=conexion();
							$categorias=$categorias->query("SELECT * FROM Categorias");
							if($categorias->rowCount()>0){
								$categorias=$categorias->fetchAll();
								foreach($categorias as $registro){
									echo('<option value="'.$registro['id'].'" >'.$registro['nombre'].'</option>');
								}
							}
							$categorias=null;
							?>
						</select>
						<label class="placeholder">Selecciona una categoria</label>
						<i class="fa-solid fa-angle-down"></i>
					</div>
					<div class="grupo">
						<select name="nivel" class="dato" required autocomplete="off">
							<option disabled selected></option>
							<?php
							$niveles=conexion();
							$niveles=$niveles->query("SELECT * FROM Niveles");
							if($niveles->rowCount()>0){
								$niveles=$niveles->fetchAll();
								foreach($niveles as $registro){
									echo('<option value="'.$registro['id'].'" >'.$registro['nombre'].'</option>');
								}
							}
							$niveles=null;
							?>
						</select>
						<label class="placeholder">Selecciona un nivel</label>
						<i class="fa-solid fa-angle-down"></i>
					</div>
					<div class="grupo doble_archivo">
						<label class="entrada dato">
							<span class="input">Miniatura</span>
							<span class="borde">3MB</span>
							<input id="archivo" type="file" name="miniatura" accept=".jpg, .png, .jpeg" hidden>
						</label>
						<label class="entrada dato otro">
							<span class="input">Insignia</span>
							<span class="borde">3MB</span>
							<input id="archivo" type="file" name="insignia" accept=".jpg, .png, .jpeg" hidden>
						</label>
					</div>
					<div class="grupo doble alto">
						<textarea type="text" name="descripcion" class="dato alto" required autocomplete="off" maxlength="512" minlength="10"></textarea>
						<label class="placeholder">Descripción</label>
					</div>
					<input type="submit" name="" value="Crear">
				</form>
			</div>
		</div>
		<div class="respuesta">
		</div>
	</main>
</body>
</html>