<?php
session_start();

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
</head>
<body>
    <h1>Panel Principal</h1>

    <p>Bienvenido, <?php echo $_SESSION["usuario"]; ?></p>

    <h2>Opciones del Sistema</h2>

    <ul>
        <li><a href="rifa.php">Reservar numeros de rifa</a></li>
        <li><a href="buscar.php">Buscar participantes</a></li>
        <li><a href="subir_comprobante.php">Subir comprobante</a></li>
        <li><a href="archivos.php">Ver comprobantes</a></li>
        <li><a href="salir.php">Cerrar sesion</a></li>
    </ul>
</body>
</html>