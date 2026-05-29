<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$datos = json_decode(file_get_contents("php://input"), true);

$operador1 = $datos["operador1"] ?? null;
$operador2 = $datos["operador2"] ?? null;
$operacion = $datos["operacion"] ?? null;

if ($operador1 === "" || $operador2 === "") {

    echo json_encode([
        "ok" => false,
        "error" => "Campos vacíos"
    ]);

    exit;
}

if ($operador1 === null || $operador2 === null || $operacion === null) {

    echo json_encode([
        "ok" => false,
        "error" => "Datos incompletos"
    ]);

    exit;
}

if (!is_numeric($operador1) || !is_numeric($operador2)) {

    echo json_encode([
        "ok" => false,
        "error" => "Solo se permiten números"
    ]);

    exit;
}

$operador1 = floatval($operador1);
$operador2 = floatval($operador2);

switch ($operacion) {

    case "suma":
        $resultado = $operador1 + $operador2;
        break;

    case "resta":
        $resultado = $operador1 - $operador2;
        break;

    case "multiplicacion":
        $resultado = $operador1 * $operador2;
        break;

    case "division":

        if ($operador2 == 0) {

            echo json_encode([
                "ok" => false,
                "error" => "No se puede dividir entre cero"
            ]);

            exit;
        }

        $resultado = $operador1 / $operador2;
        break;

    default:

        echo json_encode([
            "ok" => false,
            "error" => "Operación inválida"
        ]);

        exit;
}

echo json_encode([
    "ok" => true,
    "resultado" => $resultado
]);

?>