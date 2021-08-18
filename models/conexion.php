<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=db-reclamos-web",
			            "regrec-hnseb",
			            "^CyKF#9ry%Z*W#h#EMiQ");
		$link->exec("set names utf8");
		return $link;
	}
}