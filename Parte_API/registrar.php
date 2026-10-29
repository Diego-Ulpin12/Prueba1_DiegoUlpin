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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $datos = json_decode(file_get_contents("php://input"), true);
    if(
        !isset($datos["nombre"]) ||
        !isset($datos["apellido"]) ||
        !isset($datos["numero_rifa"]) ||
        trim($datos["nombre"]) == "" ||
        trim($datos["apellido"]) == "" ||
        !is_numeric($datos["numero_rifa"])
    ){
        http_response_code(400);
        echo json_encode([
            "mensaje" => "Debe ingresar nombre, apellido y un numero de rifa valido"
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
        $participantes = [];
    }
    
    $id = 1;

    foreach($participantes as $participante){
        if($participante["id"] >= $id){
            $id = $participante["id"] + 1;
        }
    }

    $nuevoParticipante = [
        "id" => $id,
        "nombre" => trim($datos["nombre"]),
        "apellido" => trim($datos["apellido"]),
        "numero_rifa" => (int)$datos["numero_rifa"]
    ];

    $participantes[] = $nuevoParticipante;
    $resultado = file_put_contents(
        $archivo,
        json_encode($participantes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    if($resultado == false){
        http_response_code(500);
        echo json_encode([
            "mensaje" => "Error al guardar el participante"
        ]);

        exit();
    }

    http_response_code(201);
    echo json_encode([
        "mensaje" => "Participante registrado correctamente",
        "participante" => $nuevoParticipante
    ]);

}else{
        http_response_code(405);

        echo json_encode([
            "mensaje" => "Metodo no permitido. Utilice POST"
        ]);
    }
?>