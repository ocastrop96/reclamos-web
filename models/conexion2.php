<?php
$dbHost = 'localhost';
$dbUsername = 'olgercas_reclamos';
$dbPassword = 'LReclamosHNSEB.2021';
$dbName = 'olgercas_reclamoshnseb';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db->set_charset("utf8");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
