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
    if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){
        http_response_code(400);
        echo json_encode([
            "mensaje" => "Debe ingresar un ID valido"
        ]);

        exit();
    }

    $archivo = "participantes.json";
    if(file_exists($archivo)){
        $contenido = file_get_contents($archivo);
        $participantes = json_decode($contenido, true);

        if(!is_array($participantes)){
            http_response_code(500);
            echo json_encode([
                "mensaje" => "Error al leer los participantes"
            ]);

            exit();
        }
    }else{
        http_response_code(500);
        echo json_encode([
            "mensaje" => "No se encontro el archivo de participantes"
        ]);

        exit();
    }
    
    $encontrado = false;

    foreach($participantes as $indice => $participante){
        if($participante["id"] == $_GET["id"]){
            unset($participantes[$indice]);
            $encontrado = true;
            break;
        }
    }

    if(!$encontrado){
        http_response_code(404);
        echo json_encode([
            "mensaje" => "No se encontro el participante"
        ]);

        exit();
    }

    $participantes = array_values($participantes);
    $resultado =file_put_contents(
        $archivo,
        json_encode($participantes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    if($resultado == false){
        http_response_code(500);
        echo json_encode([
            "mensaje" => "Error al eliminar el participante"
        ]);

        exit();
    }

    echo json_encode([
        "mensaje" => "Participante eliminado correctamente"
    ]);
}else{
    http_response_code(405);
    echo json_encode([
        "mensaje" => "Metodo no premitido. Utilice GET"
    ]);
}