<?php
    include_once 'conectar.php';
    session_start();

    if(!isset($_SESSION['user'])){
        header("location:index.php");
    }

    $user = $_SESSION['user'];
    $consulta = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario');
    $consulta->bindParam(':usuario', $user);
    $consulta->execute();
    $a = $consulta->fetch(PDO::FETCH_ASSOC);

    if(isset($_REQUEST['cerrar'])){
    session_destroy();
    header("location:index.php");
}

if(isset($_POST['user']) && !empty($_POST['user'])) {
    $u = $_POST['user'];
    $p = $_POST['contraseña'];
    $n = $_POST['nombre'];
    $t = $_POST['tipo'];

        $consulta = $pdo->prepare('UPDATE usuario SET usuario = :usuario, contraseña = :contraseña, nombre = :nombre, tipo = :tipo WHERE usuario = :actual_usuario');
        $consulta->bindParam(':usuario', $u);
        $consulta->bindParam(':contraseña', $p);
        $consulta->bindParam(':nombre', $n);
        $consulta->bindParam(':tipo', $t);
        $consulta->bindParam(':actual_usuario', $user);

        if ($consulta->execute()) {
            echo 'Perfil actualizado correctamente';
            header("Location: index.php");
            exit;
        } else {
            echo 'Error al actualizar el perfil';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>

<h1>Editar Perfil</h1>
    <form action="editar.php" method="post">
        Usuario <br>
        <input type="text" name="user" value="<?php echo $a['usuario']; ?>" required><br>
        Password <br>
        <input type="password" name="contraseña" value="<?php echo $a['password']; ?>" required><br>
        Nombre <br>
        <input type="text" name="nombre" value="<?php echo $a['nombre']; ?>" required><br>
        <input type="hidden" name="tipo" value="<?php echo $a['tipo']; ?>">
        <input type="submit" value="Registrar"><br>
    </form>
    
</body>
</html>