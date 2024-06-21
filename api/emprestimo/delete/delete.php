<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../../conn/conexao.php');

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
   $email = isset($data['email']) ? $data['email'] : null;

    // Valida se o ID foi fornecido
    if (!empty($id) && !empty($email)) {
        // Prepara a query SQL para deletar os dados
        $sql = "DELETE FROM emprestimo WHERE id_livro = ? AND email = ?";
        $stmt = $conn->prepare($sql);

        // Associa o parâmetro à declaração preparada
        $stmt->bind_param("is", $id, $email);

        // Executa a query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(array("message" => "emprestimo deletado com sucesso."));
            } else {
                echo json_encode(array("message" => "Nenhum emprestimo encontrado com o ID fornecido."));
            }
        } else {
            echo json_encode(array("message" => "Erro ao deletar o emprestimo: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça o ID do esmprestimo a ser deletado."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use DELETE."));
}

// Fecha a conexão
$conn->close();
?>
