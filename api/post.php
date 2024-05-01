<?php
// Verifica se a solicitação é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados enviados pelo JavaScript
    $data = json_decode(file_get_contents("php://input"));

    // Conecta ao banco de dados (substitua 'localhost', 'username', 'password' e 'database' pelos valores apropriados)
    $conn = new mysqli("localhost", "username", "password", "database");

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Prepara e executa a query de inserção
    $stmt = $conn->prepare("INSERT INTO livros (id, nome) VALUES (?, ?)");
    $stmt->bind_param("is", $data->id, $data->nome);

    if ($stmt->execute()) {
        // Se a inserção for bem-sucedida, retorna uma mensagem de sucesso
        echo "Livro adicionado com sucesso!";
    } else {
        // Se houver um erro na inserção, retorna uma mensagem de erro
        echo "Erro ao adicionar o livro: " . $conn->error;
    }

    // Fecha a conexão e a declaração
    $stmt->close();
    $conn->close();
} else {
    // Se a solicitação não for do tipo POST, retorna uma mensagem de erro
    echo "Esta página aceita apenas solicitações POST!";
}
?>