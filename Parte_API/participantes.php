<?php
session_start();

header("Content-Type: application/json");

if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
    http_response_code(401);
    echo json_encode([
        "mensaje" => "Debe iniciar sesion"
    ]);

    exit();
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $archivo ="participantes.json";

    if(file_exists($archivo)){
        $contenido = file_get_contents($archivo);
        echo $contenido;
    }else{
        http_response_code(500);
        echo json_encode([
            "mensaje" => "No se encontro el archivo de participantes"
        ]);
    }
}else{
    http_response_code(405);
    echo json_encode([
        "mensaje" => "Metodo no permitido. Utilice GET"
    ]);
}
?>