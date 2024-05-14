<?php
// Verifica se o parâmetro "acao" está presente na URL
if(isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    
    // Verifica o valor do parâmetro "acao"
    switch($mode) {
        case 'get':
            // Inclui o primeiro script PHP
            include 'get.php';
            break;
        case 'post':
            // Inclui o segundo script PHP
            include 'post.php';
            break;
        // Adicione mais casos conforme necessário para outros scripts
        default:
            // Caso nenhum caso corresponda, redireciona ou exibe uma mensagem de erro
            echo "Ação inválida!";
            break;
    }
} else {
    // Se o parâmetro "acao" não estiver presente na URL, você pode redirecionar o usuário ou fazer algo diferente.
    echo "Parâmetro 'mode' não encontrado na URL!";
}
?>