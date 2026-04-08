<?php
require_once 'conexao.php';
require_once 'auth.php';
exigir_login();

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$setor = isset($_POST['setor']) ? trim($_POST['setor']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
$situacao = isset($_POST['situacao']) ? trim($_POST['situacao']) : 'Ativo';

if ($nome == '' || $setor == '' || $email == '' || $telefone == '') {
    header('Location: cadastro.php?msg=' . urlencode('Preencha todos os campos obrigatórios.'));
    exit;
}

$nome = pg_escape_string($conexao, $nome);
$setor = pg_escape_string($conexao, $setor);
$email = pg_escape_string($conexao, $email);
$telefone = pg_escape_string($conexao, $telefone);
$situacao = pg_escape_string($conexao, $situacao);

if ($id > 0) {
    $sql = "UPDATE colaboradores SET nome = '{$nome}', setor = '{$setor}', email = '{$email}', telefone = '{$telefone}', situacao = '{$situacao}' WHERE id = {$id}";
    pg_query($conexao, $sql);
    header('Location: cadastro.php?id=' . $id . '&msg=' . urlencode('Colaborador atualizado com sucesso.'));
    exit;
}

$sql = "INSERT INTO colaboradores (nome, setor, email, telefone, situacao) VALUES ('{$nome}', '{$setor}', '{$email}', '{$telefone}', '{$situacao}')";
pg_query($conexao, $sql);
header('Location: cadastro.php?msg=' . urlencode('Colaborador cadastrado com sucesso.'));
exit;
?>
