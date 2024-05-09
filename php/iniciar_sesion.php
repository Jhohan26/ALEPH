<?php

$usuario = limpiar_cadena($_POST["login_usuario"]);
$contrasena = limpiar_cadena($_POST["login_contrasena"]);


if ($usuario == "" || $contrasena == ""){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No has llenado todos los campos que son obligatorios</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El NOMBRE no coincide con el formato solicitado</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

if (verificar_datos("[a-zA-Z0-9$@.-]{8,24}", $contrasena)){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El USUARIO no coincide con el formato solicitado</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

$contrasena = hash("SHA256", $contrasena);

$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT * FROM Usuarios WHERE nombre_usuario='$usuario' OR correo='$usuario'");
if ($check_usuario->rowCount() == 1){
	$check_usuario = $check_usuario->fetch();
	if (($check_usuario["nombre_usuario"] == $usuario || $check_usuario["correo"] == $usuario) && $contrasena == $check_usuario["contrasena"]){
		$_SESSION["id"] = $check_usuario["id"];
		$_SESSION["usuario"] = $check_usuario["nombre_usuario"];
		$_SESSION["primer_nombre"] = $check_usuario["primer_nombre"];
		$_SESSION["primer_apellido"] = $check_usuario["primer_apellido"];
		$_SESSION["segundo_nombre"] = $check_usuario["segundo_nombre"];
		$_SESSION["segundo_apellido"] = $check_usuario["segundo_apellido"];
		$_SESSION["foto"] = $check_usuario["foto"];
		if (headers_sent()){
			echo ("<script>window.location.href='../index.php'</script>");
		}
		else{
			header("Location: ../index.php");
		}
	}
	else{
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>USUARIO o CONTRASEÑA incorrecta</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
		');
		exit();
	}
}
else{
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>USUARIO o CONTRASEÑA incorrecta</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
	');
	exit();
}
unset($check_usuario);


?>