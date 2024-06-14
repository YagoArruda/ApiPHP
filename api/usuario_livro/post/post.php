<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../../conn/conexao.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(array("message" => "Erro na conexão com o banco de dados: " . $conn->connect_error)));
}

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do livro via JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_null($data)) {
        echo json_encode(array("message" => "Dados JSON inválidos ou não fornecidos."));
        exit();
    }

    $nome = isset($data['nome']) ? $data['nome'] : null;
    $cpf = isset($data['cpf']) ? $data['cpf'] : null;
    $email = isset($data['email']) ? $data['email'] : null;
    $senha = isset($data['senha']) ? $data['senha'] : null;

    // Valida se todos os campos foram fornecidos
    if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($senha)) {
        // Prepara a query SQL para inserir os dados
        $sql = "INSERT INTO usuario_livro (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Associa os parâmetros à declaração preparada
        $stmt->bind_param("siss", $nome, $cpf, $email, $senha);

        // Executa a query
        if ($stmt->execute()) {
            echo json_encode(array("message" => "Dados do usuário inseridos com sucesso."));
        } else {
            echo json_encode(array("message" => "Erro ao inserir dados do usuário: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça todos os dados do usuário."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use POST."));
}

// Fecha a conexão
$conn->close();
?>
