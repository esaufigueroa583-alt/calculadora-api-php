<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    echo json_encode([
        "ok" => false,
        "error" => "Método no permitido"
    ]);

    exit;
}

$operador1 = $_POST['operador1'] ?? null;
$operador2 = $_POST['operador2'] ?? null;
$operacion = $_POST['operacion'] ?? null;

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