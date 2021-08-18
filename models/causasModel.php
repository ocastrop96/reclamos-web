<?php
require_once "conexion.php";
class ModeloCausas
{
	static public function mdlListaCausasGenerales($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_causaGeneral BETWEEN 16 AND 21");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		//Cerramos la conexion por seguridad
		$stmt->close();
		$stmt = null;
	}
	static public function mdlListaCausasEspecificas($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		//Cerramos la conexion por seguridad
		$stmt->close();
		$stmt = null;
	}
}
