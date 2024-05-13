<?php

session_start();
require_once("./main.php");
date_default_timezone_set("America/Bogota");

$nombre = limpiar_cadena($_POST["nombre_curso"]);
$categoria = limpiar_cadena($_POST["categoria"]);
$nivel = limpiar_cadena($_POST["nivel"]);
$descripcion = limpiar_cadena($_POST["descripcion"]);
$fecha = date("Y-m-d");
$profesor = $_SESSION["id"];


if ($nombre == "" || $categoria == "" || $nivel == "" || $descripcion == ""){
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


$check_categoria=conexion();
$check_categoria=$check_categoria->query("SELECT id FROM Categorias WHERE id='$categoria'");
if($check_categoria->rowCount()<=0){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La categoría seleccionada no existe</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}
$check_categoria=null;

$check_nivel=conexion();
$check_nivel=$check_nivel->query("SELECT id FROM Niveles WHERE id='$nivel'");
if($check_nivel->rowCount()<=0){
		echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El nivel seleccionada no existe</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}
$check_nivel=null;


$img_dir = "../miniaturas/";
$miniatura = $_FILES["miniatura"];

if ($miniatura["name"] != "" && $miniatura["size"] > 0){
	if (!file_exists($img_dir)){
		if (!mkdir($img_dir, 0777)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>Error al crear el directorio</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
			exit();
		}
	}

	chmod($img_dir, 0777);
	$tipo_miniatura = explode(".", $miniatura["name"]);
	$tipo_miniatura = $tipo_miniatura[count($tipo_miniatura)-1];
	$formatos = ["jpg", "png", "jpeg"];
	if (!in_array($tipo_miniatura, $formatos)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>La miniatura que ha seleccionado es de un formato que no está permitido</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}

	if($miniatura["size"] > 3145728){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>La miniatura que ha seleccionado supera el límite de peso permitido</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}

	$img_nombre = renombrar_fotos($nombre);
	$ruta_miniatura = $img_nombre . "." . $tipo_miniatura;
	if (!move_uploaded_file($miniatura["tmp_name"], $img_dir.$ruta_miniatura)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>No podemos subir la imagen 1 al sistema en este momento, por favor intente nuevamente</p>
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
				<p>No has seleccionado ninguna miniatura</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}



$img_dir = "../insignias/";
$insignia = $_FILES["insignia"];

if ($insignia["name"] != "" && $insignia["size"] > 0){
	if (!file_exists($img_dir)){
		if (!mkdir($img_dir, 0777)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>Error al crear el directorio</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
			exit();
		}
	}

	chmod($img_dir, 0777);
	$tipo_insignia = explode(".", $insignia["name"]);
	$tipo_insignia = $tipo_insignia[count($tipo_insignia)-1];
	$formatos = ["jpg", "png", "jpeg"];
	if (!in_array($tipo_insignia, $formatos)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>La insignia que ha seleccionado es de un formato que no está permitido</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}

	if($insignia["size"] > 3145728){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>La insignia que ha seleccionado supera el límite de peso permitido</p>
					<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}

	$img_nombre = renombrar_fotos($nombre);
	$ruta_insignia = $img_nombre . "." . $tipo_insignia;
	if (!move_uploaded_file($insignia["tmp_name"], $img_dir.$ruta_insignia)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>No podemos subir la imagen 2 al sistema en este momento, por favor intente nuevamente</p>
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
				<p>No has seleccionado ninguna insignia</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

$guardar_curso=conexion();
$guardar_curso=$guardar_curso->prepare("INSERT INTO Cursos VALUES(NULL,:nombre,:descripcion,:miniatura,:insignia,:fecha,:nivel,:categoria,:profesor)");


$marcadores=[
	":nombre" => $nombre,
	":descripcion" => $descripcion,
	":miniatura" => $ruta_miniatura,
	":insignia" => $ruta_insignia,
	":fecha" => $fecha,
	":nivel" => $nivel,
	":categoria" => $categoria,
	":profesor" => $profesor
];

$guardar_curso->execute($marcadores);

if($guardar_curso->rowCount()==1){
	echo('
	<dialog id="dialogo">
		<div class="bien">
			<strong>¡CURSO REGISTRADO!</strong>
			<p>El curso se ha creado con exito</p>
			<button id="cerrar" type="submit" onclick="creacion()">Aceptar</button>
		</div>
	</dialog>
	');
}
else{
	if (is_file($img_dir.$ruta_minuatura) || is_file($img_dir.$ruta_insignia)){
		chmod($img_dir.$ruta_minuatura, 0777);
		unlink($img_dir.$ruta_minuatura);
		chmod($img_dir.$ruta_insignia, 0777);
		unlink($img_dir.$ruta_insignia);
	}
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No se pudo registrar el curso, por favor intente nuevamente</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
}
$guardar_curso=null;

?>