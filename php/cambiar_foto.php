<?php

session_start();
require_once("main.php");

/*== Almacenando datos ==*/
$id = $_SESSION["id"];

/*== Verificando producto ==*/
$check_producto=conexion();
$check_producto=$check_producto->query("SELECT * FROM Usuarios WHERE id='$id'");

if($check_producto->rowCount()==1){
	$datos=$check_producto->fetch();
}else{
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La imagen del usuario no existe</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}
$check_producto=null;


/*== Comprobando si se ha seleccionado una imagen ==*/
if($_FILES['imagen']['name']=="" || $_FILES['imagen']['size']==0){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No has seleccionado ninguna imagen</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}


/* Directorios de imagenes */
$img_dir='../photos/';


/* Creando directorio de imagenes */
if(!file_exists($img_dir)){
	if(!mkdir($img_dir,0777)){
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


/* Cambiando permisos al directorio */
chmod($img_dir, 0777);


/* Comprobando formato de las imagenes */
if(mime_content_type($_FILES['imagen']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['imagen']['tmp_name'])!="image/png"){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La imagen que ha seleccionado es de un formato que no está permitido</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}


/* Comprobando que la imagen no supere el peso permitido */
if(($_FILES['imagen']['size']/1024)>3072){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>La imagen que ha seleccionado supera el límite de peso permitido</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();

}


/* extencion de las imagenes */
switch(mime_content_type($_FILES['imagen']['tmp_name'])){
	case 'image/jpeg':
	$img_ext=".jpg";
	break;
	case 'image/png':
	$img_ext=".png";
	break;
}

/* Nombre de la imagen */
$img_nombre=renombrar_fotos($datos["nombre_usuario"]);

/* Nombre final de la imagen */
$imagen=$img_nombre.$img_ext;

/* Moviendo imagen al directorio */
if(!move_uploaded_file($_FILES['imagen']['tmp_name'], $img_dir.$imagen)){
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


/* Eliminando la imagen anterior */
if(is_file($img_dir.$datos["foto"]) && $datos["foto"]!=$imagen){

	chmod($img_dir.$datos["foto"], 0777);
	unlink($img_dir.$datos["foto"]);
}


/*== Actualizando datos ==*/
$actualizar_producto=conexion();
$actualizar_producto=$actualizar_producto->prepare("UPDATE Usuarios SET foto=:imagen WHERE id=:id");

$marcadores=[
	":imagen"=>$imagen,
	":id"=>$id
];

if($actualizar_producto->execute($marcadores)){
	echo('
	<dialog id="dialogo">
		<div class="bien">
			<strong>¡IMAGEN ACTUALIZADA!</strong>
			<p>La imagen del usuarios ha sido actualizada exitosamente</p>
			<button id="cerrar" type="submit" onclick="actualizado()">Aceptar</button>
		</div>
	</dialog>
	');
	$_SESSION["foto"] = $imagen;
}else{

	if(is_file($img_dir.$imagen)){
		chmod($img_dir.$imagen, 0777);
		unlink($img_dir.$imagen);
	}

	echo '
	<div class="notification is-warning is-light">
	<strong>¡Ocurrio un error inesperado!</strong><br>
	No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
	</div>
	';
}
$actualizar_producto=null;
