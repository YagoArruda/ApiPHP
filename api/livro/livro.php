<?php
// Defina os cabeçalhos CORS para permitir o acesso de qualquer origem
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Detecta o método de requisição
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    include 'get/get.php';
}
else {
    echo json_encode(array("message" => "Método de requisição não suportado."));
}

?>