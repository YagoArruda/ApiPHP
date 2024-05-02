<?php
header('Content-Type: application/json');

$servername = 'srv1197.hstgr.io'; 
$username = 'u689582486_user';
$password = '5e^TKn5ISqX';
$dbname = 'u689582486_teste';

$resultadoJSON = array();

// Cria conexão
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($mysqli->connect_errno) {   
    echo "Falha na conexão: " . $mysqli->connect_errno . " / " . $mysqli->connect_error;
    exit();
}

// Executa a consulta
$query = "SELECT * FROM livros";
$result = $mysqli->query($query);

// Verifica se a consulta foi bem-sucedida
if (!$result) {
    echo "Erro na consulta: " . $mysqli->error;
    exit();
}

// Verifica se existem linhas retornadas
if ($result->num_rows > 0) {
    // Itera sobre as linhas retornadas e exibe os dados
    while ($row = $result->fetch_assoc()) {
        // Adiciona os dados de cada linha como um array associativo ao array $resultadoJSON
        $livro = array(
            "id" => $row["id"],
            "nome" => $row["nome"]
        );
        // Adiciona o array do livro ao array $resultadoJSON
        $resultadoJSON[] = $livro;
    }
} 
else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão
$mysqli->close();

// Fazendo echo dos dados do livro como JSON
//echo json_encode($livro);

echo json_encode($resultadoJSON);