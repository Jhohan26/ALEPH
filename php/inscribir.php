<?php

session_start();
require_once("./main.php");


$estudiante = $_SESSION["id"];
$curso = limpiar_cadena($_POST["inscribir"]);

if ($estudiante == ""){
	header("Location: ../views/inicio.php");
}

$profesor = conexion();
$profesor = $profesor->query("SELECT profesor FROM Cursos WHERE id=$curso");
$profesor = $profesor->fetch();

if ($profesor["profesor"] == $estudiante){
	echo('
		<dialog id="dialogo">
			<div class="mal">
				<strong>¡Ocurrio un error inesperado!</strong>
				<p>No puedes inscribirte a un curso hecho por ti</p>
				<button id="cerrar" type="submit" onclick="cerrar()">Aceptar</button>
			</div>
		</dialog>
		');
	exit();
}

$verificar = conexion();
$verificar = $verificar->query("SELECT id FROM Cursos_inscritos WHERE Usuarios_id=$estudiante AND Cursos_id=$curso");
if ($verificar->rowCount() == 0){
	$inscripcion = conexion();
	$inscripcion = $inscripcion->prepare("INSERT INTO Cursos_inscritos VALUES(NULL,:estudiante,:curso)");
	$marcadores = [
	":estudiante" => $estudiante,
	":curso" => $curso
	];
	$inscripcion->execute($marcadores);
}
header("Location: ../views/curso.php?curso=$curso");

?>