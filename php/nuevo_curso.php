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
$archivo = $_FILES["miniatura"];

if ($archivo["name"] != "" && $archivo["size"] > 0){
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
	$tipo_archivo = explode(".", $archivo["name"]);
	$tipo_archivo = $tipo_archivo[count($tipo_archivo)-1];
	$formatos = ["jpg", "png", "jpeg"];
	if (!in_array($tipo_archivo, $formatos)){
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

	if($archivo["size"] > 3145728){
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
	$foto = $img_nombre . "." . $tipo_archivo;
	if (!move_uploaded_file($archivo["tmp_name"], $img_dir.$foto)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>No podemos subir la imagen al sistema en este momento, por favor intente nuevamente</p>
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

$guardar_curso=conexion();
$guardar_curso=$guardar_curso->prepare("INSERT INTO Cursos VALUES(NULL,:nombre,:descripcion,NULL,:foto,:fecha,:nivel,:categoria,:profesor)");


$marcadores=[
	":nombre" => $nombre,
	":descripcion" => $descripcion,
	":foto" => $foto,
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
	if (is_file($img_dir.$foto)){
		chmod($img_dir.$foto, 0777);
		unlink($img_dir.$foto);
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