<?php
include_once 'conectar.php';
session_start();

if(!isset($_SESSION['user'])){
    header("location:index.php");
    exit;
}

$user = $_SESSION['user'];
$consulta = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario');
$consulta->bindParam(':usuario', $user);
$consulta->execute();
$a = $consulta->fetch(PDO::FETCH_ASSOC);

if(isset($_REQUEST['cerrar'])){
    session_destroy();
    header("location:index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a tu Escuela Virtual -beta-</title>
</head>
<body>

<?php 
if(isset($a['nombre'])){
    echo "Bienvenido: ".$a['nombre'];
    echo "<br>Tipo de usuario: ".$a['tipo'];
}
?>

<br>
<a href="inicio.php?cerrar=1">Cerrar sesión</a><br>
<a href="editar.php">Editar perfil</a><br>

</body>
</html>

