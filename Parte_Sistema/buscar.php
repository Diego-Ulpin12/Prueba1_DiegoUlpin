<?php
session_start();

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    header("Location: index.php");
    exit();
}

$participantes = [
    [
        "nombre" => "Universidad",
        "apellido" => "Playa Ancha",
        "ciudad" => "Valparaiso",
        "categoria" => "Grupo A"
    ],
    [
        "nombre" => "Diego",
        "apellido" => "Ulpin",
        "ciudad" => "La Calera",
        "categoria" => "Grupo B"
    ],
    [
        "nombre" => "Santiago",
        "apellido" => "Ulpin",
        "ciudad" => "La Calera",
        "categoria" => "Grupo C"
    ],
    [
        "nombre" => "Tamara",
        "apellido" => "Gonzalez",
        "ciudad" => "La Calera",
        "categoria" => "Grupo A"
    ]
];

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["buscar"])){
    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellido"];
    $ciudad = $_GET["ciudad"];
    $categoria = $_GET["categoria"];

    $encontrado = false;

    foreach($participantes as $participante){
        if(
            $participante["nombre"] == $nombre &&
            $participante["apellido"] == $apellido &&
            $participante["ciudad"] == $ciudad &&
            $participante["categoria"] == $categoria
        ){
            $encontrado = true;
            break;
        }
    }

    if($encontrado){
        $mensaje = "Participante encontrado";
    }else{
        $mensaje = "Participante no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Buscar participanta</title>
    </head>

    <body>
        <h1>Buscar participant</h1>

        <form method="GET" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            <br><br>

            <label>Apellido:</label>
            <input type="text" name="apellido" required>
            <br><br>

            <label>Ciudad:</label>
            <input type="text" name="ciudad" required>
            <br><br>

            <label>Categoria:</label>
            <input type="text" name="categoria" required>
            <br><br>

            <button type="submit" name="buscar" value="1">Buscar</button>
        </form>

        <p><?php echo $mensaje; ?></p>

        <p><a href="panel.php">Volver al panel</a></p>
    </body>
</html>