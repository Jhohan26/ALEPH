<?php

require_once("../php/main.php");

session_start();

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
		<?php require_once("../inc/busqueda.php"); ?>
		<nav>
			<ul>
				<?php 

				if (isset($_SESSION["id"])){
				?>
					<li><a href="./inicio.php">MIS CURSOS</a></li>
					<li class="cuenta"><a href="./cuenta.php"><i class="fa-solid fa-user"></i> MI CUENTA</a></li>
					<div class="menu">
						<h4><img src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif" width="24"> Hola, <?php echo($_SESSION["usuario"]); ?></h4>
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
		<section class="landing catalogo">

			<?php
			$cursos=conexion();
			$busqueda = limpiar_cadena($_GET["busqueda"]);
			$nivel = limpiar_cadena($_GET["nivel"]);
			$categoria = limpiar_cadena($_GET["categoria"]);
			if($busqueda == ""){
				$cursos=$cursos->query("SELECT C.nombre, C.miniatura, U.nombre_usuario, U.foto FROM Cursos AS C INNER JOIN Usuarios AS U ON C.profesor = U.id");
			}
			else{
				$cursos=$cursos->query("SELECT C.nombre, C.miniatura, U.nombre_usuario, U.foto FROM
				Cursos AS C INNER JOIN Usuarios AS U ON C.profesor = U.id INNER JOIN Niveles AS N ON C.niveles_id = N.id INNER JOIN Categorias AS CA ON C.Categorias_id = CA.id
				WHERE C.nombre LIKE '%$busqueda%' OR C.descripcion LIKE '%$busqueda%' OR U.nombre_usuario LIKE '%$busqueda%' OR N.nombre LIKE '%$busqueda%' OR CA.nombre LIKE '%$busqueda%'");
			}
			if($cursos->rowCount()>0){
				?>
<!-- 				<form class="filtro" method="GET" action="">
					<div class="grupo">
						<select name="categoria" class="dato" autocomplete="off">
							<option disabled selected></option>
							<?php
							$categorias=conexion();
							$categorias=$categorias->query("SELECT * FROM Categorias");
							if($categorias->rowCount()>0){
								$categorias=$categorias->fetchAll();
								foreach($categorias as $registro){
									echo '<option value="'.$registro['id'].'" >'.$registro['nombre'].'</option>';
								}
							}
							$categorias=null;
							?>
						</select>
						<label class="placeholder">Selecciona una categoria</label>
						<i class="fa-solid fa-angle-down"></i>
					</div>
					<div class="grupo">
						<select name="nivel" class="dato" autocomplete="off">
							<option disabled selected></option>
							<?php
							$niveles=conexion();
							$niveles=$niveles->query("SELECT * FROM Niveles");
							if($niveles->rowCount()>0){
								$niveles=$niveles->fetchAll();
								foreach($niveles as $registro){
									echo '<option value="'.$registro['id'].'" >'.$registro['nombre'].'</option>';
								}
							}
							$niveles=null;
							?>
						</select>
						<label class="placeholder">Selecciona un nivel</label>
						<i class="fa-solid fa-angle-down"></i>
					</div>
					<input type="submit" name="" value="Aplicar filtros">
				</form> -->
				<?php
				$cursos=$cursos->fetchAll();
				foreach($cursos as $registro){
					echo('
						<a class="curso">
							<img class="miniatura" src="../miniaturas/'.$registro["miniatura"].'">
							<h4>'.$registro["nombre"].'</h4>
							<div class="autor">
								<img src="../photos/'.$registro["foto"].'">
								<p>'.$registro["nombre_usuario"].'</p>
							</div>
						</a>
						');
				}
			}
			else{
				echo("<h2>No se ha encontrado ningun resultado para &quot;$busqueda&quot; :(</h2>");
			}
			$cursos=null;
			?>

		</section>
	</main>
</body>
</html>