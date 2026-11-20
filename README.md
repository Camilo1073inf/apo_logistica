# Camilo Transportes - Gerenciador de Fretes

Sistema web de gerenciamento logístico desenvolvido para a Atividade Prática Orientada (APO) da disciplina **Fundamentos de Programação para Internet** - UNIPAR EAD.

## Sobre o projeto
O sistema permite cadastrar produtos, endereços (origem e destino) e transportadores, e gerar fretes que relacionam esses dados. Um transportador pode levar vários produtos no mesmo frete. Também é possível baixar um relatório com os fretes de um dia específico.

## Funcionalidades
- Cadastro, edição, listagem e exclusão de **produtos**, **endereços** e **transportadores**
- Geração de **fretes** com vários produtos (campos adicionados dinamicamente com JavaScript)
- **Relatório de fretes por dia**, com download em CSV
- Menu de navegação e interface responsiva com Bootstrap

## Tecnologias
- PHP (backend)
- MySQL/MariaDB (banco de dados)
- HTML, CSS e JavaScript
- Bootstrap 5
- XAMPP e Git/GitHub

## Como executar
1. Instale o [XAMPP](https://www.apachefriends.org/) e inicie o **Apache** e o **MySQL**.
2. Clone este repositório dentro da pasta `htdocs`:
   ```
   git clone https://github.com/Camilo1073inf/apo_logistica.git
   ```
3. Abra o `phpMyAdmin` (`http://localhost/phpmyadmin`), crie o banco `apo_logistica` e importe o arquivo `database/banco.sql`.
4. Acesse `http://localhost/apo_logistica/` no navegador.

## Estrutura de pastas
```
apo_logistica/
├── assets/            imagens e CSS
├── config/            conexão com o banco
├── database/          script SQL das tabelas
├── enderecos/         cadastro de endereços
├── fretes/            geração e listagem de fretes
├── includes/          cabeçalho, rodapé e funções
├── produtos/          cadastro de produtos
├── relatorios/        relatório de fretes por dia
├── transportadores/   cadastro de transportadores
└── index.php          página inicial
```

## Autor
- **Nome:** Wictor Hugo Camilo de Oliveira
- **RA:** 09230923
- **Curso:** Sistemas da informacao
- **Polo:** Cascavel

https://youtu.be/x-Zk5I8JUG8