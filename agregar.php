<?php

    include_once 'conectar.php';
    session_start();

    if($_SESSION['user']){
        header("location:inicio.php");
    }

    if(isset($_REQUEST['u']) && !empty($_REQUEST['u'])){
        $u = $_REQUEST['u'];
        $p = $_REQUEST['p'];

        $consulta = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario AND password = :password');
        $consulta->bindParam(':usuario', $u);
        $consulta->bindParam(':password', $p);
        $consulta->execute();
    
        $registrado = $consulta->rowCount();

        if($registrado == 1){
            $_SESSION['user'] = $u;
            header("Location: inicio.php");
            exit;
        } else {
            echo "Usuario o contraseña incorrecto";
        }
    }

?>