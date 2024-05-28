<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../../conn/conexao.php');

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

    $id= isset($data['id']) ? $data['id'] : null;
    $situacao= isset($data['situacao']) ? $data['situacao'] : null;

    // Valida se todos os campos foram fornecidos
    if (!empty($id) && !empty($situacao)) {
        // Prepara a query SQL para atualizar os dados
        $sql = "UPDATE status_livro SET situacao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Associa os parâmetros à declaração preparada
        $stmt->bind_param("si", $situacao,$id);

        // Executa a query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(array("message" => "Dados do usuario atualizados com sucesso."));
            } else {
                echo json_encode(array("message" => "Nenhum usuario encontrado com o CPF fornecido."));
            }
        } else {
            echo json_encode(array("message" => "Erro ao atualizar dados do usuario: " . $stmt->error));
        }

        // Fecha a declaração preparada e a conexão
        $stmt->close();
    } else {
        echo json_encode(array("message" => "Por favor, forneça todos os dados do usuario."));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido. Use PUT."));
}

// Fecha a conexão
$conn->close();
?>
