<?php
require_once 'conexao.php';
require_once 'auth.php';

$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if ($usuario == '' || $senha == '') {
    header('Location: index.php?erro=' . urlencode('Preencha usuário e senha.'));
    exit;
}

$usuario_sql = pg_escape_string($conexao, $usuario);
$senha_md5 = md5($senha);

$sql = "SELECT id, nome_completo, usuario FROM usuarios WHERE usuario = '{$usuario_sql}' AND senha = '{$senha_md5}' LIMIT 1";
$resultado = pg_query($conexao, $sql);

if ($resultado && pg_num_rows($resultado) == 1) {
    $dados = pg_fetch_assoc($resultado);
    $_SESSION['usuario_id'] = $dados['id'];
    $_SESSION['usuario_nome'] = $dados['nome_completo'];
    $_SESSION['usuario_login'] = $dados['usuario'];

    header('Location: listagem.php');
    exit;
}

header('Location: index.php?erro=' . urlencode('Credenciais inválidas.'));
exit;
?>
