<?php
echo json_encode(array(
        "Devolucao" => array(
            "Get" => [],
            "Post" => ["id", "data", "cpf"],
            "Update" => ["id", "data", "cpf"],
            "Delete" => ["id"]
        ),
        "Emprestimo" => array(
            "Get" => [],
            "Post" => ["id", "data", "cpf"],
            "Update" => ["id", "data", "cpf"],
            "Delete" => ["id"]
        ),
        "Livros" => array(
            "Get" => [],
            "Post" => ["id", "nome", "autor", "resumo", "genero"],
            "Update" => ["id", "nome", "autor", "resumo", "genero"],
            "Delete" => ["id"]
        ),
        "Livro" => array(
            "Get" => ["*Vai se basear no id passado na url*"]
        ),
        "Status_Livro" => array(
            "Get" => [],
            "Post" => ["id", "situacao"],
            "Update" => ["id", "situacao"],
            "Delete" => ["id"]
        ),
        "Usuario_Livro" => array(
            "Get" => [],
            "Post" => ["cpf", "nome", "email", "senha"],
            "Update" => ["cpf", "nome", "email", "senha"],
            "Delete" => ["cpf"]
        ),
        "Docs" => array(
            "Get" => [],
            "Description" => "Permite ver informações de uso da API."
        ),
        "API_Link" => "https://phaccess.vercel.app/"
));
?>
