<?php
if(isset($_GET['op'])) {
    $op = $_GET['op'];
    
    switch($op) {
        case 'get':
            include 'get.php';
            break;
        case 'post':
            $gid = isset($_GET['id']);
            $gnome = isset($_GET['nome']);
            $gautor = isset($_GET['autor']);
            $gresumo = isset($_GET['resumo']);
            $ggenero = isset($_GET['genero']);
            if($gnome && $gautor && $gresumo && $ggenero) {

                if($gid){
                    include 'postWId.php';
                }
                include 'post.php';

            }
            else{
                echo "Parâmetro não encontrado na URL!";
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
            <p>Última alteração: 21/05/2024</p>
            <br>
            </body>
            </html>
            <?php
}
?>