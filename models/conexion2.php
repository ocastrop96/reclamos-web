<?php
$dbHost = 'localhost';
$dbUsername = 'regrec-hnseb';
$dbPassword = '^CyKF#9ry%Z*W#h#EMiQ';
$dbName = 'db-reclamos-web';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db->set_charset("utf8");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
