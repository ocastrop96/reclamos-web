<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=olgercas_reclamoshnseb",
			            "olgercas_reclamos",
			            "LReclamosHNSEB.2021");
		$link->exec("set names utf8");
		return $link;
	}
}