<?php
$host = 'localhost';
$port = '5432';
$dbname = 'colaboradores';
$user = 'postgres';
$password = '12345';

$conexao = pg_connect("host={$host} port={$port} dbname={$dbname} user={$user} password={$password}");

if (!$conexao) {
    die('Erro ao conectar ao banco PostgreSQL. Revise o arquivo conexao.php.');
}
?>
