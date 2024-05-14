<?php
if(isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    
    switch($mode) {
        case 'get':
            include 'get.php';
            break;
        case 'post':
            if(isset($_GET['id'])){

                $bookId = $_GET['id'];

                if(isset($_GET['name'])){
                    $bookName = $_GET['name'];

                    include 'post.php';
                }
                else{
                    echo "Parâmetro 'name' não encontrado na URL!";
                }
                
            }
            else{
                echo "Parâmetro 'id' não encontrado na URL!";
            }
            
            break;
        default:
            echo "Ação inválida!";
            break;
    }
} else {
    echo "Metodos implementados:\n🟢 Get -[Sem parametro necessario]\n🟡 Post - mode=post&id='0'&name='Livro Teste'\n🔴 Delete [Ainda não implementado] - \n🔴 Edit [Ainda não implementado] - \n\n\n############ \n\n\n🟢 - Completo\n🟡 - Completo, mas pode melhorar\n🔴 - Não implementado ou não funcional \n\n\nProjeto ApiPHP github: [https://github.com/YagoArruda/ApiPHP.git]\nUltima alteração: 14/05/2024";
}
?>