<?php

require_once("../php/main.php");

session_start();

if (!isset($_SESSION["id"])){
	if (headers_sent()){
		echo ("<script>window.location.href='../index.php'</script>");
	}
	else{
		header("Location: ../index.php");
	}
}
$usuario = $_SESSION["id"];


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
				<li><a href="../index.php">SOBRE ALEPH</a></li>
				<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
				<div class="menu">
					<h4><img class="mano" src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>

					<a href="./logout.php">Cerrar sesión</a>
				</div>
			</ul>
		</nav>
	</header>
	<main>
		<section class="landing cursos">
			<?php
			$cursos=conexion();
			if ($_SESSION["rol"] == 1){
				$cursos=$cursos->query("SELECT C.id, C.nombre, C.miniatura, U.nombre_usuario FROM Cursos AS C INNER JOIN Usuarios AS U ON C.profesor = U.id WHERE C.profesor=$usuario");
				if($cursos->rowCount()>0){
					$cursos=$cursos->fetchAll();
					foreach($cursos as $registro){
						echo('
								<div class="tarjeta">
									<img src="../miniaturas/'.$registro["miniatura"].'">
									<div class="info">
										<h2>'.$registro["nombre"].'</h2>
										<p>'.$registro["nombre_usuario"].'</p>
									</div>
									<div class="botones">
										<a href="./videos.php"><button class="ir"><i class="fa-solid fa-play"></i> Añadir video</button></a>
										<a href=""><button class="eliminar"><i class="fa-solid fa-trash"></i> Eliminar</button></a>
									</div>
								</div>
							');
					}
				}
				else{
					echo("<h2>No tienes ningun curso creado :(</h2>");
				}
				echo('<a href="./crear.php"><button><i class="fa-solid fa-plus"></i> Crear curso</button></a>');
			}
			$cursos=conexion();
			$cursos=$cursos->query("SELECT C.id, C.nombre, C.miniatura, U.nombre_usuario FROM Cursos AS C INNER JOIN Cursos_inscritos AS I ON C.id=I.Cursos_id INNER JOIN Usuarios AS U ON C.profesor=U.id WHERE I.Usuarios_id=$usuario");
			if($cursos->rowCount()>0){
				$cursos=$cursos->fetchAll();
				foreach($cursos as $registro){
					echo('
							<div class="tarjeta">
								<img src="../miniaturas/'.$registro["miniatura"].'">
								<div class="info">
									<h2>'.$registro["nombre"].'</h2>
									<p>'.$registro["nombre_usuario"].'</p>
								</div>
								<div class="botones">
									<a href="./curso.php?curso='.$registro["id"].'"><button class="ir"><i class="fa-solid fa-play"></i> Ir al curso</button></a>
									<a href=""><button class="eliminar"><i class="fa-solid fa-trash"></i> Eliminar</button></a>
								</div>
							</div>
						');
				}
			}
			else{
				echo("<h2>No te has inscrito a ningun curso :(</h2>");
			}
			$cursos=null;
			?>
			</div>
		</section>
	</main>
</body>
</html>