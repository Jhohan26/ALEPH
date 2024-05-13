<?php

require_once("./main.php");


$correo = strtolower($_POST["correo"]);
$primera_contrasena = limpiar_cadena($_POST["primera_contrasena"]);
$segunda_contrasena = limpiar_cadena($_POST["segunda_contrasena"]);


if ($correo == "" || $primera_contrasena == "" || $segunda_contrasena == ""){
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

if(verificar_datos("[a-zA-Z0-9$@.-]{8,24}",$primera_contrasena)){
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

if(verificar_datos("[a-zA-Z0-9$@.-]{8,24}",$segunda_contrasena)){
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

if($primera_contrasena != $segunda_contrasena){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La CONTRASEÑAS no coinciden</p>
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
		if($check_correo->rowCount()!=1){
			echo('
				<dialog id="dialogo">
					<div class="mal">
						<strong>¡Ocurrio un error inesperado!</strong>
						<p>El correo electrónico no se encuentra registrado</p>
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

$primera_contrasena = hash("SHA256", $primera_contrasena);

$cambiar_contrasena=conexion();

$cambiar_contrasena=$cambiar_contrasena->prepare("UPDATE Usuarios SET contrasena=:contrasena WHERE correo=:correo");

$marcadores=[
	":correo" => $correo,
	":contrasena" => $primera_contrasena
];

$cambiar_contrasena->execute($marcadores);

if($cambiar_contrasena->rowCount()==1){
	echo('
	<dialog id="dialogo">
		<div class="bien">
			<strong>¡CONTRASEÑA CAMBIADA!</strong>
			<p>La contraseña se ha cambiado con exito</p>
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
			<p>La contraseña no puede ser la misma que la anterior</p>
			<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
		</div>
	</dialog>
	');
}
$cambiar_contrasena=null;

?>