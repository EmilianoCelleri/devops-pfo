<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['usuario']) && isset($input['contrasena'])) {
        $usuario = trim($input['usuario']);
        $contrasena = trim($input['contrasena']);

        if (strlen($usuario) < 3 || strlen($contrasena) < 6) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "mensaje" => "Usuario debe tener al menos 3 caracteres y la contraseña 6 caracteres."
            ]);
        } else {
            echo json_encode([
                "status" => "ok",
                "mensaje" => "Datos recibidos correctamente.",
                "usuario" => $usuario
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "mensaje" => "Faltan datos requeridos."
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "mensaje" => "Método no permitido. Usá POST."
    ]);
}
?>