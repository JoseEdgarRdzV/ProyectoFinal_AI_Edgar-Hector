<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

if (isset($_POST['cerrar'])) {
    session_destroy();
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a tu Escuela Virtual</title>
</head>
<body>
    <h1>Bienvenido a tu Escuela Virtual</h1>
    <p>Bienvenido: <?php echo $_SESSION['user']; ?></p>
    <a href="editar.php">Editar perfil</a><br>
    <a href="agregar.php">Agregar clase</a><br>
    <a href="unirse.php">Unirse a clase</a><br>
    <form action="inicio.php" method="post">
        <input type="submit" value="Cerrar sesión" name="cerrar">
    </form>
</body>
</html>