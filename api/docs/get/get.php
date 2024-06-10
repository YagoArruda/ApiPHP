<?php
echo json_encode(array("message" => `

## 🟢 Devolução: (.../devolucao)
#### Get - []
#### Post - [id, data, cpf]
#### Update - [id, data, cpf]
#### Delete - [id]

## 🟢 Emprestimo: (.../emprestimo)
#### Get - []
#### Post - [id, data, cpf]
#### Update - [id, data, cpf]
#### Delete - [id]

## 🟢 Livros: (.../livros)
#### Get - []
#### Post - [id, nome, autor, resumo, genero]
#### Update - [id, nome, autor, resumo, genero]
#### Delete - [id]

## 🟢 Livro: (.../livro?id='')
#### Get - [*Vai se basear no id passado na url*]
*Serve apenas para acessar um livro individualmente

## 🟢 Status_Livro: (.../statusLivro)
#### Get - []
#### Post - [id, situacao]
#### Update - [id, situacao]
#### Delete - [id]

## 🟢 Usuario_Livro: (.../usuarioLivro)
#### Get - []
#### Post - [cpf, nome, email, senha]
#### Update - [cpf, nome, email, senha]
#### Delete - [cpf]

############

## 🟢 Docs: (.../docs)
#### Get - []
*Permite ver informações de uso da API.

API: <a href="https://phaccess.vercel.app/">https://phaccess.vercel.app/</a>
`));
?>
