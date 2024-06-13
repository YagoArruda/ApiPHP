<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../conn/conexao.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o método de requisição é GET
if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_null($data)) {
        echo json_encode(array("message" => "Dados JSON inválidos ou não fornecidos."));
        exit();
    }

    $email = isset($data['email']) ? $data['email'] : null;
    $senha = isset($data['senha']) ? $data['senha'] : null;

    if ($email === null || $senha === null) {
        echo json_encode(array("message" => "Email ou senha não fornecidos."));
        exit();
    }

    // Executa a query para selecionar os dados
    $sql = "SELECT * FROM `usuario_livro` WHERE email = $email";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        $resposta = $result->fetch_assoc();
        
        if ($resposta['senha'] == $senha && $resposta['email'] == $email) {
            echo json_encode(array("resposta" => "True"));
        } else {
            echo json_encode(array("resposta" => "False", "message" => "Senha incorreta."));
        }
    } else {
        echo "Nenhum usuario encontrado.";
    }
} else {
    echo "Método de requisição inválido. Use GET.";
}





// Fecha a conexão
$conn->close();
?>
