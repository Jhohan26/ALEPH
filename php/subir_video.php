<?php

session_start();
require_once("./main.php");
$id = $_SESSION["id"];
$curso = limpiar_cadena($_POST["curso"]);
$descripcion = limpiar_cadena($_POST["descripcion_video"]);


if(($_FILES['video']['size']/1024)>512000){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El video que ha seleccionado supera el límite de peso permitido</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

if ($id == "" || $curso == "" || $descripcion == ""){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No has llenado todos los campos que son obligatorios</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}


$check_usuario=conexion();
$check_usuario=$check_usuario->query("SELECT * FROM Usuarios WHERE id='$id' AND rol=1");

if($check_usuario->rowCount()!=1){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No eres un profesor o no tienes permiso</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}
$check_usuario=null;


if($_FILES['video']['name']=="" || $_FILES['video']['size']==0){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No has seleccionado ninguna video</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}


$img_dir='../videos/';


if(!file_exists($img_dir)){
	if(!mkdir($img_dir,0777)){
		echo('
			<dialog id="dialogo">
				<div class="mal">
					<strong>¡Ocurrio un error inesperado!</strong>
					<p>Error al crear el directorio</p>
					<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
				</div>
			</dialog>
			');
		exit();
	}
}


chmod($img_dir, 0777);


if(mime_content_type($_FILES['video']['tmp_name'])!="video/mp4" && mime_content_type($_FILES['video']['tmp_name'])!="video/mp4"){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>El video que ha seleccionado es de un formato que no está permitido</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

$nombre_curso=conexion();
$nombre_curso=$nombre_curso->query("SELECT * FROM Cursos WHERE id='$curso'");
$nombre_curso=$nombre_curso->fetch();

$img_nombre=renombrar_fotos($nombre_curso["nombre"]);

$video=$img_nombre.".mp4";

if(!move_uploaded_file($_FILES['video']['tmp_name'], $img_dir.$video)){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No podemos subir la video al sistema en este momento, por favor intente nuevamente</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}


$guardar_video=conexion();
$guardar_video=$guardar_video->prepare("INSERT INTO Videos VALUES(NULL,:video,:descripcion,:curso)");

$marcadores=[
	":video"=>$video,
	":descripcion"=>$descripcion,
	":curso"=>$curso
];

if($guardar_video->execute($marcadores)){
	echo('
	<dialog id="dialogo">
		<div class="bien">
			<strong>¡VIDEO ALMACENADO!</strong>
			<p>El video del curso ha sido almacenado exitosamente</p>
			<button id="cerrar" type="submit" onclick="subido()">Aceptar</button>
		</div>
	</dialog>
	');
}else{
	if(is_file($img_dir.$video)){
		chmod($img_dir.$video, 0777);
		unlink($img_dir.$video);
	}

	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No podemos subir el video al sistema en este momento, por favor intente nuevamente</p>
				<button id="cerrar" type="submit" onclick="reiniciar()">Aceptar</button>
			</div>
		</dialog>
		');
}
$guardar_video=null;

?>