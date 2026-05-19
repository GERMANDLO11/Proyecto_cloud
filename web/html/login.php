<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body{
            font-family: Arial;
            background:#f0f2f5;
        }

        .login-box{
            width:350px;
            margin:120px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
        }

        button{
            width:100%;
            padding:10px;
            background:#2c3e50;
            color:white;
            border:none;
        }

        .error{
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Acceso Panel Docker</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            Usuario o contraseña incorrectas
        </div>
    <?php endif; ?>

    <form action="validar.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>