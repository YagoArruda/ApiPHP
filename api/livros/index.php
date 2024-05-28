<?php
// Defina os cabeçalhos CORS para permitir o acesso de qualquer origem
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Detecta o método de requisição
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // Inclui o arquivo post.php para tratar a requisição POST
    include 'post/post.php';
} 
else if($method == 'GET'){
    include 'get/get.php';
}else if($method == 'DELETE'){
    include 'delete/delete.php';
}else if($method == 'PUT'){
    include 'update/update.php';
} else {
    echo json_encode(array("message" => "Método de requisição não suportado."));
}

?>