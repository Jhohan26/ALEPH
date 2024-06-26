<?php

require_once("../php/main.php");

session_start();

if (!isset($_GET["curso"])){
	header("Location: ./catalogo.php");
}
$curso_id = $_GET["curso"];

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
				<?php 

				if (isset($_SESSION["id"])){
				?>
					<li><a href="./cursos.php">MIS CURSOS</a></li>
					<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
					<div class="menu">
						<h4><img class="mano" src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
						<a href="./logout.php">Cerrar sesión</a>
					</div>

				<?php }else{ ?>

					<li><a href="./inicio.php">INICIAR SESION</a></li>
					<li><a href="./registro.php">REGISTRARSE</a></li>

				<?php } ?>

			</ul>
		</nav>
	</header>
	<main>
		<section class="landing descripcion">
			<?php
			$curso=conexion();
			$curso=$curso->query("SELECT C.id, C.nombre, C.miniatura, C.fecha_publicacion, C.descripcion, U.nombre_usuario, U.foto FROM Cursos AS C INNER JOIN Usuarios AS U ON C.profesor = U.id WHERE C.id=$curso_id");
			$cantidad = conexion();
			$estudiante = $_SESSION["id"];
			$estudiante = isset($estudiante) ? $estudiante : "";
			$cantidad = $cantidad->query("SELECT COUNT(id) AS cantidad FROM Cursos_inscritos WHERE Cursos_id=$curso_id");


			if($curso->rowCount()>0){
				$curso=$curso->fetch();
				$cantidad=$cantidad->fetch();
				$curso["foto"] = $curso["foto"] == "" ? "user.jpg" : $curso["foto"];
				$id_curso = $curso["id"];
				if ($estudiante != ""){
					$verificar = conexion();
					$verificar = $verificar->query("SELECT id FROM Cursos_inscritos WHERE Usuarios_id=$estudiante AND Cursos_id=$id_curso");
				}
				if($estudiante == ""){
					$boton = '
						<input type="hidden" name="inscribir" value="'.$curso["id"].'">
						<button type="submit" onclick="creacion()">Inscribirse</button>
					';
				}
				else if($verificar->rowCount() == 0){
					$boton = '
					<form method="POST" action="../php/inscribir.php" class="formulario" style="margin:0; padding:0; display:inline;">
						<input type="hidden" name="inscribir" value="'.$curso["id"].'">
						<button type="submit">Inscribirse</button>
					</form>
					';
				}
				else{
					$boton = '<a href="./recurso.php?curso='.$curso["id"].'"><button>Ver contenido</button></a>';
				}
				echo('
					<div class="izquierda">
						<img src="../miniaturas/'.$curso["miniatura"].'">
						<h2 class="titulo">'.$curso["nombre"].'</h2>
						<div class="profesor">
							<img src="../photos/'.$curso["foto"].'">
							<p>'.$curso["nombre_usuario"].'</p>
							'.$boton.'
						</div>
					</div>
					<div class="derecha">
						<div class="texto">
							<div>
								<h4>'.$cantidad["cantidad"].' estudiantes <i class="fa-solid fa-users"></i></i></h4>
								<h5>'.$curso["fecha_publicacion"].' <i class="fa-regular fa-calendar-days"></i></h5>
							</div>
							<p>'.$curso["descripcion"].'</p>
						</div>
					</div>
					');
			}
			else{
				header("Location: ./catalogo.php");
			}

			?>
		</section>
		<div class="respuesta">
		</div>
	</main>
</body>
</html>