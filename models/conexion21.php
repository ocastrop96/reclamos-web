<?php
$server = "localhost";
$user = "regrec-hnseb";
$pass = "^CyKF#9ry%Z*W#h#EMiQ";
$db = "db-reclamos-web";
$conexion = mysqli_connect($server, $user, $pass, $db);
mysqli_set_charset($conexion, "utf8");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
