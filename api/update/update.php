<?php
header('Content-Type: application/json');

// Dados de conexão com o banco de dados
$servername = 'srv1197.hstgr.io';
$username = 'u689582486_user';
$password = '5e^TKn5ISqX';
$dbname = 'u689582486_teste';

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(array("message" => "Erro na conexão com o banco de dados: " . $conn->connect_error)));
}

// Verifica se o método de requisição é PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Recebe os dados via JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_null($data)) {
        echo json_encode(array("message" => "Dados JSON inválidos ou não fornecidos."));
        exit();
    }

    $id = isset($data['id']) ? $data['id'] : null;
    $nome = isset($data['nome']) ? $data['nome'] : null;
    $autor = isset($data['autor']) ? $data['autor'] : null;
    $resumo = isset($data['resumo']) ? $data['resumo'] : null;
    $genero = isset($data['genero']) ? $data['genero'] : null;

    // Valida se todos os campos foram fornecidos
    if (!empty($id) && !empty($nome) && !empty($autor) && !empty($resumo) && !empty($genero)) {
        // Prepara a query SQL para atualizar os dados
        $sql = "UPDATE livros SET nome = ?, autor = ?, resumo = ?, genero = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Associa os parâmetros à declaração preparada
        $stmt->bind_param("ssssi", $nome, $autor, $resumo, $genero, $id);

        // Executa a query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(array("message" => "Dados do livro atualizados com sucesso."));
            } else {
                echo json_encode(array("message" => "Nenhum livro encontrado com o ID fornecido."));
            }
        } else {
            echo json_encode(array("message" => "Erro ao atualizar dados do livro: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça todos os dados do livro."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use PUT."));
}

// Fecha a conexão
$conn->close();
?>
