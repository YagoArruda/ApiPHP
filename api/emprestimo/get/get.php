<?php
header('Content-Type: application/json');
include realpath(__DIR__ . '/../../conn/conexao.php');

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if(isset($_REQUEST['email'])){
    $email = $_GET['email']; 
}
else{
    echo "email não informado";
}

// Verifica se o método de requisição é GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Executa a query para selecionar os dados
    $sql = "SELECT *
FROM emprestimo
LEFT JOIN capa_livro ON emprestimo.id_livro = capa_livro.id
LEFT JOIN livros ON emprestimo.id_livro = livros.id_livro
WHERE emprestimo.email = $email

UNION

SELECT *
FROM emprestimo
RIGHT JOIN capa_livro ON emprestimo.id_livro = capa_livro.id
RIGHT JOIN livros ON emprestimo.id_livro = livros.id_livro
WHERE emprestimo.email = $email;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $livros = array();
        while($row = $result->fetch_assoc()) {
            $livros[] = $row;
        }
        echo json_encode($livros);
    } else {
        echo "Nenhum emprestimo encontrado.";
    }
} else {
    echo "Método de requisição inválido. Use GET.";
}

// Fecha a conexão
$conn->close();
?>
