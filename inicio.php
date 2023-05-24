<?php
    include_once 'conectar.php';
    session_start();
    $user = $_SESSION['user'];
    $consulta = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario');
    $consulta->bindParam(':usuario', $user);
    $consulta->execute();
    $a = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    
</body>
</html>