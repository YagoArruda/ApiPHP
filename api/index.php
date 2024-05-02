<?php
// Dados de conexão com o banco de dados
$servername = 'srv1197.hstgr.io';
$username = 'u689582486_user';
$password = '5e^TKn5ISqX';
$dbname = 'u689582486_teste';

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se a requisição é um POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura os dados enviados pelo cliente
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO livros (id, nome) VALUES (?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Associa os parâmetros
        $stmt->bind_param("ss", $id, $nome);

        // Executa a declaração
        $stmt->execute();

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("mensagem" => "Dados inseridos com sucesso."));
        } else {
            echo json_encode(array("erro" => "Falha ao inserir os dados."));
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo json_encode(array("erro" => "Falha na preparação da declaração SQL."));
    }
} else {
    // Se não for uma requisição POST, retorna um erro
    http_response_code(405); // Método não permitido
    echo json_encode(array("erro" => "Apenas requisições POST são permitidas."));
}

// Fecha a conexão com o banco de dados
$conn->close();