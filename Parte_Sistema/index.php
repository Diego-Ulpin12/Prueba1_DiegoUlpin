<?php
session_start();

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $respuesta_captcha = $_POST["respuesta_captcha"];

    if(
        $usuario == "userupla" &&
        $password == "upla123" &&
        $respuesta_captcha == $_SESSION["captcha"]
    ){
        $_SESSION["autenticado"] = true;
        $_SESSION["usuario"] = $usuario;

        header("Location: panel.php");
        exit();
    }else{
        $mensaje = "Usuario, contraseña o CAPTCHA incorrectos.";
    }
    }


$num1 = rand(1, 10);
$num2 = rand(1, 10);
$operacion = rand(1,2);

if($operacion == 1){
    $simbolo = "+";
    $_SESSION["captcha"] = $num1 + $num2;
}else{
    $simbolo = "-";
    $_SESSION["captcha"] = $num1 - $num2;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>

    <p><?php echo $mensaje; ?></p>
    
    <form method="POST" action="">
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
        <br><br>
        
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br><br>

        <label>Resuelve la operacion:</label>
        <?php echo $num1 . " " . $simbolo . " " . $num2; ?>

        <input type="number"  name="respuesta_captcha" required>
        <br><br>
        
        <input type="submit" value="Ingresar">
    </form>

    </body>
</html>