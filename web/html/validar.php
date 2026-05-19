<?php
session_start();
require "conexion.php";

$usuario = $_POST['usuario'];
$password = hash('sha256', $_POST['password']);

$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 1) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
?>