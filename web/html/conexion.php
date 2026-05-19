<?php
$conexion = new mysqli("mariadb", "root", "rootpass", "paneldocker");

if ($conexion->connect_error) {
    die("Error de conexión");
}
?>