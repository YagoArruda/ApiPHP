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
    echo "Parâmetro 'mode' não encontrado na URL!";
}
?>