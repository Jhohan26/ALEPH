<?php

require_once("../php/main.php");

session_start();

$curso_id = limpiar_cadena($_GET["curso"]);
$estudiante = $_SESSION["id"];
$video_index = $_GET["video"];

$video_index = (!isset($video_index) OR $video_index == "") ? "" : $video_index;

if (!isset($_GET["curso"])){
	header("Location: ./catalogo.php");
}

if (!isset($_SESSION["id"])){
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
	<script type="text/javascript" src="../js/ver_videos.js" defer></script>
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
			<?php
				try{
					$ultimo_video = conexion();
					$ultimo_video = $ultimo_video->query("SELECT IFNULL(MAX(Videos_id),0) AS ultimo FROM Videos_vistos WHERE Usuarios_id=$estudiante AND Cursos_id=$curso_id");
					$ultimo_video = $ultimo_video->fetch()["ultimo"];
					if($ultimo_video != "0"){
						$boton = '<button type="submit" name="direccion" value="atras" class="este"><i class="fa-solid fa-chevron-left"></i></button>';
					}
					$video_actual = conexion();
					$video_actual = $video_actual->query("SELECT id AS actual FROM Videos WHERE Cursos_id=$curso_id AND id>$ultimo_video LIMIT 1");
					$video_actual = $video_actual->fetch()["actual"];
					if ($video_index != ""){
						if (intval($video_index) <= $ultimo_video){
							$video_actual = $video_index;
						}
					}
					$verificar_primer = conexion();
					$verificar_primer = $verificar_primer->query("SELECT id FROM Videos WHERE Cursos_id=$curso_id");
					$verificar_primer = $verificar_primer->fetch()["id"];
					if (intval($video_index) == intval($verificar_primer)){
						$boton = "";
					}
					$video = conexion();
					$video = $video->query("SELECT V.nombre, V.descripcion, V.orden, C.nombre AS curso, C.fecha_publicacion, U.foto, U.nombre_usuario FROM Videos AS V INNER JOIN Cursos AS C ON V.Cursos_id = C.id INNER JOIN Usuarios AS U ON C.profesor = U.id WHERE V.id = $video_actual");
					if ($video->rowCount() == 1){
						$video = $video->fetch();
						echo('
							<div class="izquierda">
								<form class="flechas" method="POST" action="../php/cambiar_video.php" style="margin:0; padding:0;">
										<input type="hidden" name="estudiante" value="'.$estudiante.'">
										<input type="hidden" name="curso" value="'.$curso_id.'">
										<input type="hidden" name="video" value="'.$video_actual.'">
										'.$boton.'
										<button type="submit" name="direccion" value="adelante" class="oeste desactivado" disabled><i class="fa-solid fa-chevron-right"></i></button>
									<video controls autoplay>
										<source src="../videos/'.$video["nombre"].'" type="video/mp4">
									</video>
									<h2 class="titulo">'.$video["orden"].'. '.$video["curso"].'</h2>
									<div class="profesor">
										<img src="../photos/'.$video["foto"].'">
										<p>'.$video["nombre_usuario"].'</p>
									</div>
								</form>
							</div>
							<div class="derecha">
								<div class="texto">
									<div>
										<h4>0 vistas <i class="fa-regular fa-eye"></i></i></h4>
										<h5>'.$video["fecha_publicacion"].' <i class="fa-regular fa-calendar-days"></i></h5>
									</div>
									<p>'.$video["descripcion"].'</p>
								</div>
							</div>
							');
					}
				}
				catch(Exception $error){
					$verificar_finalizacion = conexion();
					$verificar_finalizacion = $verificar_finalizacion->query("SELECT id FROM Cursos_realizados WHERE Cursos_id=$curso_id AND Usuarios_id=$estudiante");
					if($verificar_finalizacion->rowCount()==0){
						$insertar = conexion();
						$insertar = $insertar->query("INSERT INTO Cursos_realizados VALUES(NULL,$estudiante,$curso_id)");
					}
					echo("<h1>Has terminado todo el curso ¡Felicidades!");
				}
			?>

		</section>
		<div class="respuesta">
		</div>
	</main>
</body>
</html>