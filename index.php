<?php
require_once 'auth.php';
if (usuario_logado()) {
    header('Location: listagem.php');
    exit;
}
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Gestão de Colaboradores</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="pagina-login">
    <div class="card-login alternativa-login">
        <div class="faixa-login"></div>
        <div class="titulo-login-area coluna">
            <div class="icone-usuario-login alternativo"></div>
            <div>
                <h1>Gestão de Colaboradores</h1>
                <p class="subtitulo-login">Acesso ao painel administrativo</p>
            </div>
        </div>

        <?php if ($erro != '') { ?>
            <div class="mensagem erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php } ?>

        <form action="login.php" method="post">
            <div class="campo-login menor">
                <span class="icone-campo">ID</span>
                <input type="text" name="usuario" placeholder="Informe seu usuário" required>
            </div>

            <div class="campo-login menor">
                <span class="icone-campo">**</span>
                <input type="password" name="senha" placeholder="Informe sua senha" required>
            </div>

            <button type="submit" class="botao botao-primario botao-login compacto">Acessar Sistema</button>
        </form>

        <div class="linha-login pequena"></div>
        <p class="aviso-login">Ambiente acadêmico - PHP5 com PostgreSQL</p>
    </div>
</body>
</html>
