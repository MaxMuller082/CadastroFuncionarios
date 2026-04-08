<?php
require_once 'auth.php';
exigir_login();
$pagina_ativa = isset($pagina_ativa) ? $pagina_ativa : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Colaboradores</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="pagina-interna">
    <div class="container-principal">
        <div class="topo-sistema">
            <div class="logo-area">
                <div class="logo-circulo"></div>
                <span>Gestão de Colaboradores</span>
            </div>

            <div class="menu-topo">
                <a href="cadastro.php" class="<?php echo ($pagina_ativa == 'cadastro') ? 'ativo' : ''; ?>">Cadastro</a>
                <a href="listagem.php" class="<?php echo ($pagina_ativa == 'listagem') ? 'ativo' : ''; ?>">Consulta</a>
            </div>

            <div class="usuario-topo">
                Usuário: <?php echo htmlspecialchars(nome_usuario_logado()); ?>
                <a href="logout.php" class="sair-link">Encerrar</a>
            </div>
        </div>
