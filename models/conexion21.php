<?php
$server = "localhost";
$user = "olgercas_reclamos";
$pass = "LReclamosHNSEB.2021";
$db = "olgercas_reclamoshnseb";
$conexion = mysqli_connect($server, $user, $pass, $db);
mysqli_set_charset($conexion, "utf8");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
