<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../../conn/conexao.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o método de requisição é GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Executa a query para selecionar os dados
    $sql = "SELECT * FROM livros FULL JOIN capa_livro ON capa_livro.id = id_livro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $livros = array();
        while($row = $result->fetch_assoc()) {
            $livros[] = $row;
        }
        echo json_encode($livros);
    } else {
        echo "Nenhum livro encontrado.";
    }
} else {
    echo "Método de requisição inválido. Use GET.";
}

// Fecha a conexão
$conn->close();
?>
