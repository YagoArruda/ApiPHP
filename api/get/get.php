<?php
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

// Verifica se o método de requisição é GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Executa a query para selecionar os dados
    $sql = "SELECT * FROM livros";
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
