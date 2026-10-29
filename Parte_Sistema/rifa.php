<?php
session_start();

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    header("Location: index.php");
    exit();
}

if(!isset($_SESSION["cantidad"])){
    $_SESSION["cantidad"] = 0;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["accion"] == "agregar"){
        $_SESSION["cantidad"]++;
    }else if($_POST["accion"] == "quitar"){
        if($_SESSION["cantidad"] > 0){
            $_SESSION["cantidad"]--;
        }
    }

    header("Location: rifa.php");
    exit();
}

$cantidad = $_SESSION["cantidad"];
$precio = 2000;
$total = $cantidad * $precio;
?>

<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Reserva de Numeros</title>
        </head>

        <body>
            <h1>Reserva de numueros de rifa</h1>

            <p>Cantidad de numeros: <?php echo $cantidad; ?></p>
            <p>Precio por numero: <?php echo $precio; ?></p>
            <p>Total: <?php echo $total; ?></p>

            <form method="POST" action="">
                <button type="submit" name="accion" value="agregar">
                    Agregar numero
                </button>

                <button type="submit" name="accion" value="quitar">
                    Quitar numero
                </button>
            </form>

            <p><a href="panel.php">Volver al panel</a></p>
        </body>
    </html>