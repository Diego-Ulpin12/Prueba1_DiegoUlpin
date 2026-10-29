<?php
session_start();

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    header("Location: index.php");
    exit();
}

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES["comprobante"]) && $_FILES["comprobante"]["error"] == 0){
        $carpeta = "comprobantes/";
        $archivo = basename($_FILES["comprobante"]["name"]);
        $destino = $carpeta . $archivo;

        if(move_uploaded_file($_FILES["comprobante"]["tmp_name"], $destino)){
            $mensaje = "Comprobante subido correctamente.";
        }else{
            $mensaje = "Error al subir el comprobante.";
        }
    }else{
        $mensaje = "Debes seleccionar el archivo valido";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Subir comprobante</title>
    </head>

    <body>
        <h1>Subir comprobante</h1>

        <form method="POST" action="" enctype="multipart/form-data">
            <label>Selecciona el comprobante:</label>
            <input type="file" name="comprobante" required>
            <br><br>

            <button type="submit">Subir archivo</button>
        </form>

        <p><a href="panel.php">Volver al panel</a></p>
    </body>
</html>