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

// Verifica se o método de requisição é DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Recebe os dados via JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (is_null($data)) {
        echo json_encode(array("message" => "Dados JSON inválidos ou não fornecidos."));
        exit();
    }

   $id = isset($data['id']) ? $data['id'] : null;
   
    // Valida se o ID foi fornecido
    if (!empty($id)) {
        // Prepara a query SQL para deletar os dados
        $sql = "DELETE FROM livros WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Associa o parâmetro à declaração preparada
        $stmt->bind_param("i", $id);

        // Executa a query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(array("message" => "Livro deletado com sucesso."));
            } else {
                echo json_encode(array("message" => "Nenhum livro encontrado com o ID fornecido."));
            }
        } else {
            echo json_encode(array("message" => "Erro ao deletar o livro: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça o ID do livro a ser deletado."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use DELETE."));
}

// Fecha a conexão
$conn->close();
?>