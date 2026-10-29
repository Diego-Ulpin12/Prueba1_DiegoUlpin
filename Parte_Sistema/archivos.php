<?php
session_start();

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    header("Location: index.php");
    exit();
}

$carpeta = "comprobantes/";
$archivos = [];

if(is_dir($carpeta)){
    $archivos = scandir($carpeta);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ver comprobantes</title>
    </head>

    <body>
        <h1>Comprobantes subidos</h1>

        <?php
        if(count($archivos) > 2){
            echo "<ul>";

            foreach($archivos as $archivo){
                if($archivo != "." && $archivo != ".."){
                    echo "<li>". htmlspecialchars($archivo) ."</li>";
                }
            }
            
            echo "</ul>";
        }else{
            echo "<p>No hay comprobantes subidos.</p>";
        }
        ?>

        <p><a href="panel.php">Volver al panel</a></p>       
    </body>
</html>