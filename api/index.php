<?php
if(isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    
    switch($mode) {
        case 'get':
            include 'get.php';
            break;
        case 'post':
            if(isset($_GET['name'])){

                $bookName = $_GET['name'];
                include 'post.php';

            }
            else{
                echo "Parâmetro 'name' não encontrado na URL!";
            }
            
            break;
        default:
            echo "Ação inválida!";
            break;
    }
} else {
    ?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>ApiPHP: Hub</title>
            </head>
            <br>
            <h1>Métodos implementados:</h1>
            <p>🟢 Get - [Sem parâmetro necessário]</p>
            <p>🟡 Post - mode=post&name=Livro Teste</p>
            <p>🔴 Delete [Ainda não implementado] - </p>
            <p>🔴 Edit [Ainda não implementado] - </p>
            <br>
            <p>############</p>
            <br>
            <p>🟢 - Completo</p>
            <p>🟡 - Completo, mas pode melhorar</p>
            <p>🔴 - Não implementado ou não funcional</p>
            <p>Projeto API PHP no GitHub: [<a href="https://github.com/YagoArruda/ApiPHP.git">https://github.com/YagoArruda/ApiPHP.git</a>]</p>
            <p>Última alteração: 14/05/2024</p>
            <br>
            </body>
            </html>
            <?php
}
?>