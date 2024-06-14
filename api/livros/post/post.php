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
    $autor = isset($data['autor']) ? $data['autor'] : null;
    $resumo = isset($data['resumo']) ? $data['resumo'] : null;
    $genero = isset($data['genero']) ? $data['genero'] : null;
    $capa = isset($data['capa']) ? $data['capa'] : null;

    // Valida se todos os campos foram fornecidos
    if (!empty($nome) && !empty($autor) && !empty($resumo) && !empty($genero) && !empty($capa)) {
        // Prepara a query SQL para inserir os dados
        $sql = "INSERT INTO livros (nome, autor, resumo, genero) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Associa os parâmetros à declaração preparada
        $stmt->bind_param("ssss", $nome, $autor, $resumo , $genero);

        $sql = "INSERT INTO capa_livro (capa) VALUES (?)";
        $stmt2 = $conn->prepare($sql);

        $stmt2->bind_param("s", $capa);
        $stmt2->execute();
        // Executa a query
        if ($stmt->execute()) {
            echo json_encode(array("message" => "Dados do livro inseridos com sucesso."));
        } else {
            echo json_encode(array("message" => "Erro ao inserir dados do livro: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça todos os dados do livro."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use POST."));
}

// Fecha a conexão
$conn->close();
?>
