<?php

session_start();

require_once("../php/main.php");

if (!isset($_SESSION["id"])){
	if (headers_sent()){
		echo ("<script>window.location.href='../index.php'</script>");
	}
	else{
		header("Location: ../index.php");
	}
}

$estudiante = $_SESSION["id"];

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
				<li><a href="./cursos.php">MIS CURSOS</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section class="landing cuenta">
			<div class="izquierda">
				<div class="tarjeta">
					<img class="user" src="<?php 

					$ruta = $_SESSION["foto"] != "" ? $_SESSION["foto"] : "user.jpg";
					$ruta = "../photos/".$ruta;

					echo($ruta);

					 ?>">
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
					<div>
						<a href="./logout.php">Cerrar Sesion</a>
						<a href="./foto.php" class="cambiar">Cambiar Foto</a>
					</div>
				</div>
			</div>
			<div class="derecha">
				<div class="tarjeta logros">
					<h3>LOGROS</h3>
					<?php
						$logros = conexion();
						$logros = $logros->query("SELECT C.id, C.insignia FROM Cursos_realizados AS R INNER JOIN Cursos AS C ON R.Cursos_id=C.id WHERE R.Usuarios_id=$estudiante");
						if ($logros->rowCount() > 0){
							$logros = $logros->fetchAll();
							foreach ($logros as $curso){
								echo('<a href="./curso.php?curso='.$curso["id"].'"><img src="../insignias/'.$curso["insignia"].'"></a>');
							}
						}
						else{
							echo('<h4>Por el momento no has terminado ninguno curso</h4>');
						}
					?>
				</div>
				<div class="tarjeta progreso">
					<h3>PROGRESO</h3>
					<?php

					$cursos = conexion();
						$cursos = $cursos->query("SELECT I.Cursos_id, C.nombre FROM Cursos_inscritos AS I INNER JOIN Cursos AS C ON I.Cursos_id=C.id WHERE Usuarios_id=$estudiante");
					if ($cursos->rowCount() > 0){
						$cursos = $cursos->fetchAll();
						foreach ($cursos as $curso){
							$nombre = $curso["nombre"];
							$id_curso = $curso["Cursos_id"];

							$total = conexion();
							$total = $total->query("SELECT COUNT(id) AS total FROM Videos WHERE Cursos_id=$id_curso");
							$total = $total->fetch()["total"];

							$realizados = conexion();
							$realizados = $realizados->query("SELECT COUNT(id) AS cantidad FROM Videos_vistos WHERE Cursos_id=$id_curso AND Usuarios_id=$estudiante");
							$realizados = $realizados->fetch()["cantidad"];

							$porcentaje = (100/$total) * $realizados;
							$porcentaje = round($porcentaje);

							echo('
								<div class="pro_curso">
									<h5>'.$nombre.'</h5>
									<div class="barra">
										<div class="completado" style="width: '.$porcentaje.'%;"></div>
									</div>
									<p>'.$porcentaje.'%</p>
								</div>
								');
						}

					}
					else{
						echo('<h4>No estas realizando ningun curso en el momento</h4');
					}

					?>
				</div>
			</div>
		</section>
	</main>
</body>
</html>