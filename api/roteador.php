<?php

header('Content-Type: Application/json; charset=utf-8');


$rotas = require __DIR__ . "/routes.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$rota = str_replace("/xama2/api", "", $uri);

$rota_chamada = "$method $rota";

// validaçao
if(!isset($rotas[$rota_chamada])) {
    http_response_code(404);
    echo json_encode(["error" => "rota nao encontrada"]);
    exit;
}



?>