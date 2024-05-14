<?php
// Dados de conexão com o banco de dados
$servername = 'srv1197.hstgr.io';
$username = 'u689582486_user';
$password = '5e^TKn5ISqX';
$dbname = 'u689582486_teste';

// Dados do livro
$id = "autoIncrement";
$nome = "O Paraiso";//$bookName;

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Prepara a query SQL para inserir os dados
$sql = "INSERT INTO livros (id, nome) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Associa os parâmetros à declaração preparada
$stmt->bind_param("is",$id,$nome);

// Executa a query
if ($stmt->execute()) {
    echo "Dados do livro inseridos com sucesso.";
} else {
    echo "Erro ao inserir dados do livro: " . $conn->error;
}

// Fecha a declaração preparada e a conexão
$stmt->close();
$conn->close();
?>