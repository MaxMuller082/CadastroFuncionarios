<?php
if (session_id() == '') {
    session_start();
}

function usuario_logado() {
    return isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']);
}

function exigir_login() {
    if (!usuario_logado()) {
        header('Location: index.php');
        exit;
    }
}

function nome_usuario_logado() {
    return isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : 'Admin';
}
?>
