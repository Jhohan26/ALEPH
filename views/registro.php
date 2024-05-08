<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>ALEPH | cursos</title>
	<script src="https://kit.fontawesome.com/b48cdd04ea.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/ajax.js" defer></script>
</head>
<body>
	<header>
		<a class="logo" href="../index.html">
			<img src="../logos/blanco.svg">
			<h2 class="texto_logo">ALEPH</h2>
		<a>
		<form class="busqueda" method="GET">
			<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off">
			<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<nav>
			<ul>
				<li><a href="">SOBRE ALEPH</a></li>
				<li><a href="">INICIAR SESION</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="landing">
			<div class="izquierda">
				<h1>REGISTRATE</h1>
				<h4>Aprende a tu propio ritmo con nosotros</h4>
				<form class="registro formulario" method="POST" action="../php/registrar.php">
					<div class="grupo">
						<input type="text" name="primer_nombre" class="dato" required autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}" maxlength="20", min="3">
						<label class="placeholder">Primer Nombre<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="segundo_nombre" class="dato" autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}" maxlength="20", min="0">
						<label class="placeholder">Segundo Nombre</label>
					</div>
					<div class="grupo">
						<input type="text" name="primer_apellido" class="dato" required autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}" maxlength="20", min="3">
						<label class="placeholder">Primer Apellido<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="segundo_apellido" class="dato" autocomplete="off" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}" maxlength="20", min="0">
						<label class="placeholder">Segundo Apellido</label>
					</div>
					<div class="grupo">
						<input type="email" name="correo" class="dato" required autocomplete="off" maxlength="45">
						<label class="placeholder">Correo Electrónico<span>*</span></label>
					</div>
					<div class="grupo">
						<input type="text" name="usuario" class="dato" required autocomplete="off" pattern="[a-zA-Z0-9]{4,20}" maxlength="20", min="4">
						<label class="placeholder">Nombre de Usuario<span>*</span></label>
					</div>
					<div class="grupo doble">
						<input type="password" id="contra" name="contrasena" class="dato" required autocomplete="off" pattern="[a-zA-Z0-9$@.-]{8,24}" maxlength="20", min="8">
						<label class="placeholder">Contraseña<span>*</span></label>
						<i class="fa-regular fa-eye" id="ojo"></i>
					</div>
					<p>Entre 8 y 24 caracteres</p>
					<input type="submit" name="" value="Registrar">
				</form>
			</div>
			<div class="derecha">
				<img src="../images/registro.svg">
			</div>
		</div>
		<div class="respuesta">
		</div>
	</main>
	<script type="text/javascript">
		let datos = document.querySelectorAll(".dato");

		for (let dato of datos){
			dato.addEventListener("input", function() {
				if (this.value == ""){
					this.classList.remove("lleno");
				}
				else{
					this.classList.add("lleno");
				}
			});
		}

		let ojo = document.getElementById("ojo");
		let contra = document.getElementById("contra");

		ojo.addEventListener("click", function() {
			if (contra.getAttribute("type") == "text"){
				contra.setAttribute("type", "password");
				this.classList.add("fa-eye");
				this.classList.remove("fa-eye-slash");
			}
			else{
				contra.setAttribute("type", "text");
				this.classList.add("fa-eye-slash");
				this.classList.remove("fa-eye");
			}
		});
		function cerrar(){
			let modal = document.getElementById("dialogo");
			modal.style.display = "none";
		}
	</script>
</body>
</html>