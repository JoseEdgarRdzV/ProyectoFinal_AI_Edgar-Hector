<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'conectar.php';

// Registro de usuario
if (isset($_POST['registro'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    if (empty($user) || empty($password) || empty($nombre) || empty($tipo)) {
        echo 'Los campos están vacíos';
    } else {
        $consulta = $pdo->prepare('SELECT * FROM alumnos WHERE usuario = :usuario');
        $consulta->bindParam(':usuario', $user);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            echo 'El usuario ya existe';
        } else {
            $insertar = $pdo->prepare('INSERT INTO alumnos (alumno_id, usuario, password, nombre, tipo) VALUES (NULL, :usuario, :password, :nombre, :tipo)');
            $insertar->bindParam(':usuario', $user);
            $insertar->bindParam(':password', $password);
            $insertar->bindParam(':nombre', $nombre);
            $insertar->bindParam(':tipo', $tipo);

            if ($insertar->execute()) {
                echo '¡Felicidades, has sido registrado correctamente!';
                header("Location: inicio.php");
                exit;
            } else {
                echo 'No pudiste ser registrado :(';
            }
        }
    }
}

session_start();

if (isset($_SESSION['user'])) {
    header("location:inicio.php");
    exit;
}

if (isset($_POST['iniciar'])) {
    $user = $_POST['u'];
    $password = $_POST['p'];

    if (empty($user) || empty($password)) {
        echo 'Los campos están vacíos';
    } else {
        $consulta = $pdo->prepare('SELECT * FROM alumnos WHERE usuario = :usuario AND password = :password');
        $consulta->bindParam(':usuario', $user);
        $consulta->bindParam(':password', $password);
        $consulta->execute();

        $registrado = $consulta->rowCount();

        if ($registrado == 1) {
            $_SESSION['user'] = $user;
            header("Location: inicio.php");
            exit;
        } else {
            echo "Usuario o contraseña incorrecto";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProyectoFinal_Hector_Edgar</title>
</head>
<body>
    <h1>Waos</h1>
    <hr>
    <h1>Iniciar Sesión</h1>
    <form action="index.php" method="post">
        Usuario <br>
        <input type="text" name="u" placeholder="Introduce Usuario" required><br>
        Contraseña <br>
        <input type="password" name="p" placeholder="Introduce Contraseña" required><br>
        <input type="submit" value="Iniciar" name="iniciar"><br>
    </form>
    <hr>
    <h1>Registro</h1>
    <form action="index.php" method="post">
        Usuario <br>
        <input type="text" name="user" placeholder="Introduce Usuario" required><br>
        Contraseña <br>
        <input type="password" name="password" placeholder="Introduce Contraseña" required><br>
        Nombre <br>
        <input type="text" name="nombre" placeholder="Introduce Nombre" required><br>
        Tipo <br>
        <select name="tipo" id="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br><br>
        <input type="submit" value="Registrar" name="registro"><br>
    </form>
</body>
</html>
