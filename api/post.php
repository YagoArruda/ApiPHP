<?php
header('Content-Type: application/json');

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do livro enviados via POST
    $nome = $_POST["nome"];

    // Configurações de conexão com o banco de dados
    $servername = 'srv1197.hstgr.io';
    $username = 'u689582486_user';
    $password = '5e^TKn5ISqX';
    $dbname = 'u689582486_teste';

    // Cria conexão
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($mysqli->connect_errno) {
        echo "Falha na conexão: " . $mysqli->connect_errno . " / " . $mysqli->connect_error;
        exit();
    }

    // Prepara a consulta SQL para inserção do novo livro
    $query = "INSERT INTO `livros`(`id`, `nome`) VALUES ('4','[value-2]')";
    $stmt = $mysqli->prepare($query);

    // Verifica se a consulta foi preparada com sucesso
    if ($stmt === false) {
        echo "Erro na preparação da consulta: " . $mysqli->error;
        exit();
    }

    // Associa os parâmetros da consulta com os valores recebidos via POST
    $stmt->bind_param("s", $nome);

    // Executa a consulta
    $result = $stmt->execute();

    // Verifica se a consulta foi bem-sucedida
    if ($result === false) {
        echo "Erro na execução da consulta: " . $stmt->error;
        exit();
    }

    // Fecha a declaração
    $stmt->close();

    // Fecha a conexão
    $mysqli->close();

    // Retorna uma mensagem de sucesso
    echo "Livro adicionado com sucesso!";
} else {
    // Retorna uma mensagem de erro se a requisição não for do tipo POST
    echo "Método não permitido. Utilize o método POST para enviar os dados do livro.";
}
