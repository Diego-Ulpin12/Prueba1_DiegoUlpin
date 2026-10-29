<?php
session_start();

header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $datos = json_decode(file_get_contents("php://input"), true);
    if(
        isset($datos["usuario"]) &&
        isset($datos["password"]) &&
        $datos["usuario"] == "userupla" &&
        $datos["password"] == "upla123"
    ){
        session_regenerate_id(true);
        $_SESSION["autenticado"] = true;
        $_SESSION["usuario"] = $datos["usuario"];

        echo json_encode([
            "mensaje" => "Inicio de sesion correcto"
        ]);
    }else{
        http_response_code(401);

        echo json_encode([
            "mensaje" => "Usuario o contraseña incorrectos"
        ]);
    }
}else{
    http_response_code(405);

    echo json_encode([
        "mensaje" => "Metodo no permitido. Utilice POST"
    ]);
}
?>