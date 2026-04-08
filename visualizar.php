<?php
require_once 'conexao.php';
$pagina_ativa = 'listagem';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$colaborador = false;

if ($id > 0) {
    $sql = "SELECT * FROM colaboradores WHERE id = {$id} LIMIT 1";
    $resultado = pg_query($conexao, $sql);
    if ($resultado && pg_num_rows($resultado) == 1) {
        $colaborador = pg_fetch_assoc($resultado);
    }
}
?>

<div class="cabecalho-pagina faixa-clara">
    <h2>Detalhamento do Colaborador</h2>
</div>

<div class="conteudo-box">
    <div class="box-formulario detalhes-box formato-v2">
        <?php if ($colaborador) { ?>
            <div class="box-titulo destaque-v2">
                <span class="icone-box">👤</span>
                <h3><?php echo htmlspecialchars($colaborador['nome']); ?></h3>
            </div>

            <div class="detalhes-grid detalhes-v2">
                <div><strong>Código:</strong> <?php echo htmlspecialchars($colaborador['id']); ?></div>
                <div><strong>Setor:</strong> <?php echo htmlspecialchars($colaborador['setor']); ?></div>
                <div><strong>E-mail:</strong> <?php echo htmlspecialchars($colaborador['email']); ?></div>
                <div><strong>Telefone:</strong> <?php echo htmlspecialchars($colaborador['telefone']); ?></div>
                <div><strong>Situação:</strong> <?php echo htmlspecialchars($colaborador['situacao']); ?></div>
                <div><strong>Cadastro:</strong> <?php echo htmlspecialchars($colaborador['data_cadastro']); ?></div>
            </div>

            <div class="acoes-formulario alinhado-esquerda">
                <a href="cadastro.php?id=<?php echo $colaborador['id']; ?>" class="botao botao-primario">Editar</a>
                <a href="listagem.php" class="botao botao-link">Voltar</a>
            </div>
        <?php } else { ?>
            <div class="mensagem erro">Colaborador não encontrado.</div>
            <div class="acoes-formulario alinhado-esquerda">
                <a href="listagem.php" class="botao botao-link">Voltar</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
