<?php
    include_once 'conectar.php';

    if($_POST){
        $u = $_POST['user'];
        $p = $_POST['contraseña'];
        $n = $_POST['nombre'];
        $t = $_POST['tipo'];

        $consulta = $pdo->prepare('INSERT INTO usuario (usuario, contraseña, nombre, tipo) VALUES (:usuario, :contraseña, :nombre, :tipo)');
        $consulta->bindParam(':usuario', $u);
        $consulta->bindParam(':contraseña', $p);
        $consulta->bindParam(':nombre', $n);
        $consulta->bindParam(':tipo', $t);
    
        if ($consulta->execute()){ 
            echo 'Felicidades, fuiste agregado correctamente';
        } else {
            echo 'No pudiste ser agregado :c';
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
    <h1>Iniciar Sesion</h1>
    <form action="index.php" method="post">
        usuario <br>
        <input type="text" name="u" placeholder="Introduce Usuario" required><br>
        password <br>
        <input type="password" name="p" placeholder="Introduce Constraseña" required><br>
        <input type="submit" value="Iniciar"><br>

    </form>
<hr>
    <h1>Registro</h1>
    <form action="index.php" method="post">
        Usuario <br>
        <input type="text" name="user" placeholder="Introduce Usuario" required><br>
        Password <br>
        <input type="password" name="contraseña" placeholder="Introduce Constraseña" required><br>
        Nombre <br>
        <input type="text" name="nombre" placeholder="Introduce Nombre" required><br>
        Tipo <br>
        <select name="tipo" id="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br><br>
        <input type="submit" value="Registrar"><br>
    </form>

</body>
</html>