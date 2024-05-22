<?php

require_once("./main.php");

$direccion = $_POST["direccion"];
$estudiante = $_POST["estudiante"];
$curso = $_POST["curso"];
$video = $_POST["video"];

if ($direccion == "adelante"){
	$verificar_video = conexion();
	$verificar_video = $verificar_video->query("SELECT id FROM Videos_vistos WHERE Usuarios_id=$estudiante AND Videos_id=$video AND Cursos_id=$curso");
	if ($verificar_video->rowCount() == 0){
		$guardar_progreso = conexion();
		$guardar_progreso = $guardar_progreso->prepare("INSERT INTO Videos_vistos VALUES(NULL,:usuario,:video,:curso)");
		$marcadores = [
			":usuario" => $estudiante,
			":video"=> $video,
			":curso"=> $curso
		];
		$guardar_progreso->execute($marcadores);
	}
}
else if($direccion == "atras"){
	$video_anterior = conexion();
	$video_anterior = $video_anterior->query("SELECT MAX(Videos_id) AS video_anterior FROM Videos_vistos WHERE Usuarios_id=$estudiante AND Cursos_id=$curso AND Videos_id<$video");
	$video_anterior = $video_anterior->fetch()["video_anterior"];
	header("Location: ../views/recurso.php?curso=$curso&video=$video_anterior");
	exit();
}
header("Location: ../views/recurso.php?curso=$curso");



?>