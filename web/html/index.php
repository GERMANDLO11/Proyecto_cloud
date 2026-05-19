<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$servicios = [ 
    "web" => "Servidor Web Apache",
    "mariadb" => "Base de datos MariaDB",
    "mcserver" => "Servidor Minecraft"
];

function estado($nombre) {
    $salida = shell_exec("docker inspect -f '{{.State.Running}}' $nombre 2>/dev/null");

    if ($salida === null) {
        return false;
    }

    return trim($salida) === "true";
}

if (isset($_GET['accion'], $_GET['servicio'])) {
    $accion = $_GET['accion'];
    $servicio = $_GET['servicio'];

    if (in_array($accion, ["start", "stop", "restart"])) {
        shell_exec("docker $accion $servicio");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración Docker</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h2 style="text-align:center;">Panel de Control de Contenedores Docker</h2>
    <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    <table>
        <tr>
            <th>Servicio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($servicios as $id => $nombre): ?>
        <tr>
            <td><?= $nombre ?></td>
            <td class="<?= estado($id) ? 'on':'off' ?>">
                <?= estado($id) ? 'EN EJECUCIÓN' : 'DETENIDO' ?>
            </td>
            <td>
                <a class="start" href="?accion=start&servicio=<?= $id ?>">Start</a>
                <a class="stop" href="?accion=stop&servicio=<?= $id ?>">Stop</a>
                <a class="restart" href="?accion=restart&servicio=<?= $id ?>">Restart</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
