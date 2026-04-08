# Gestão de Colaboradores

Sistema web acadêmico desenvolvido em **PHP5** com **PostgreSQL** para controle básico de colaboradores.

## Funcionalidades

- login de acesso
- cadastro de colaboradores
- edição e exclusão
- consulta com busca por texto
- filtro por situação
- visualização de detalhes

## Tecnologias

- PHP 5
- PostgreSQL
- HTML5
- CSS3
- XAMPP

## Estrutura

```
gestao_colaboradores_v2/
├── index.php
├── login.php
├── logout.php
├── cadastro.php
├── salvar.php
├── listagem.php
├── visualizar.php
├── excluir.php
├── conexao.php
├── auth.php
├── header.php
├── footer.php
├── database.sql
└── assets/
```

## Como executar

1. Coloque a pasta dentro de `C:\xampp\htdocs`.
2. Crie o banco `gestao_colaboradores` no PostgreSQL.
3. Execute o script `database.sql`.
4. Ajuste a senha no arquivo `conexao.php`.
5. Inicie o Apache no XAMPP.
6. Acesse `http://localhost/gestao_colaboradores_v2`.

## Acesso padrão

- **Usuário:** admin
- **Senha:** 123456
