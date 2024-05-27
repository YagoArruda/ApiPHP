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
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do livro via JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $nome = $data['nome'];
    $autor = $data['autor'];
    $resumo = $data['resumo'];
    $genero = $data['genero'];

    // Valida se todos os campos foram fornecidos
    if (!empty($nome) && !empty($autor) && !empty($resumo) && !empty($genero)) {
        // Prepara a query SQL para inserir os dados
        $sql = "INSERT INTO livros (nome, autor, resumo, genero) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Associa os parâmetros à declaração preparada
        $stmt->bind_param("ssss", $nome,$autor, $resumo, $genero);

        // Executa a query
        if ($stmt->execute()) {
            echo "Dados do livro inseridos com sucesso.";
        } else {
            echo "Erro ao inserir dados do livro: " . $conn->error;
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo "Por favor, forneça todos os dados do livro.";
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use POST."));
}

// Fecha a conexão
$conn->close();
?>
