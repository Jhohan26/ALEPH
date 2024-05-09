<?php

require_once("./main.php");

$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];


if ($primer_nombre == "" || $primer_apellido == "" || $usuario == "" || $correo == "" || $contrasena == ""){
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

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}",$primer_nombre) || verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}",$segundo_nombre)){
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

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,20}",$primer_apellido) || verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{0,20}",$segundo_apellido)){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El APELLIDO no coincide con el formato solicitado</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
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

if(verificar_datos("[a-zA-Z0-9$@.-]{8,24}",$contrasena)){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La CONTRASEÑA no coincide con el formato solicitado</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

if($correo!=""){
	if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
		$check_correo=conexion();
		$check_correo=$check_correo->query("SELECT correo FROM Usuarios WHERE correo LIKE '$correo'");
		if($check_correo->rowCount()>0){
			echo('
				<dialog id="dialogo">
					<div class="mal">
						<strong>¡Ocurrio un error inesperado!</strong>
						<p>El correo electrónico ingresado ya se encuentra registrado, por favor elija otro</p>
						<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
					</div>
				</dialog>
				');
			exit();
		}
		$check_email=null;
	}
	else{
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>Ha ingresado un correo electrónico no valido</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}
}

$check_usuario=conexion();
$check_usuario=$check_usuario->query("SELECT nombre_usuario FROM Usuarios WHERE nombre_usuario LIKE '$usuario'");
if($check_usuario->rowCount()>0){
	echo('
	<dialog id="dialogo">
		<div class="mal">
			<strong>¡Ocurrio un error inesperado!</strong>
			<p>El USUARIO ingresado ya se encuentra registrado, por favor elija otro</p>
			<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
		</div>
	</dialog>
	');
	exit();
}
$check_usuario=null;

$contrasena = hash("SHA256", $contrasena);

$guardar_usuario=conexion();
$guardar_usuario=$guardar_usuario->prepare("INSERT INTO Usuarios VALUES(NULL, :primer_nombre,:segundo_nombre,:primer_apellido,:segundo_apellido,:usuario,:correo,:contrasena,'',1)");

$marcadores=[
	":primer_nombre" => $primer_nombre,
	":segundo_nombre" => $segundo_nombre,
	":primer_apellido" => $primer_apellido,
	":segundo_apellido" => $segundo_apellido,
	":usuario" => $usuario,
	":correo" => $correo,
	":contrasena" => $contrasena
];

$guardar_usuario->execute($marcadores);

if($guardar_usuario->rowCount()==1){
	echo('
	<dialog id="dialogo">
		<div class="bien">
			<strong>¡USUARIO REGISTRADO!</strong>
			<p>El usuario se registro con exito</p>
			<button id="cerrar" type="submit" onclick="creacion()">Aceptar</button>
		</div>
	</dialog>
	');
}
else{
	echo('
	<dialog id="dialogo">
		<div class="mal">
			<strong>¡Ocurrio un error inesperado!</strong>
			<p>No se pudo registrar el usuario, por favor intente nuevamente</p>
			<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
		</div>
	</dialog>
	');
}
$guardar_usuario=null;

?>