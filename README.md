# Resumo
Projeto de uma Api feita interamente em PHP e hospedada no Vercel, para ser usada para se comunicar com um banco de livros SQL.

# Métodos
#### 🟢 Get - Implementado
#### 🟢 Post - Implementado
#### 🟢 Update - Implementado
#### 🟢 Delete - Implementado

* Cada um desses métodos existe para [livros,emprestimo,devolucao,usuarioLivro,statusLivro].

# Tabelas
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

## 🟢 Login: (.../login)
#### Get - [email, senha]
*Confere se os dados de login estão corretos

############

#### 🟢 - Completo
#### 🟡 - Completo, mas pode melhorar
#### 🔴 - Não implementado ou não funcional

API: <a href="https://phaccess.vercel.app/">https://phaccess.vercel.app/</a>

# Informações sobre o Vercel
Teste com node.js configurado na versão 18.
