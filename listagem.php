<?php
require_once 'conexao.php';
$pagina_ativa = 'listagem';
require_once 'header.php';

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$filtro_situacao = isset($_GET['situacao']) ? trim($_GET['situacao']) : '';
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$pagina = ($pagina < 1) ? 1 : $pagina;
$itens_por_pagina = 6;
$offset = ($pagina - 1) * $itens_por_pagina;

$condicoes = array();
if ($busca != '') {
    $busca_sql = pg_escape_string($conexao, $busca);
    $condicoes[] = "(nome ILIKE '%{$busca_sql}%' OR setor ILIKE '%{$busca_sql}%' OR email ILIKE '%{$busca_sql}%')";
}
if ($filtro_situacao != '') {
    $situacao_sql = pg_escape_string($conexao, $filtro_situacao);
    $condicoes[] = "situacao = '{$situacao_sql}'";
}

$filtro = '';
if (count($condicoes) > 0) {
    $filtro = ' WHERE ' . implode(' AND ', $condicoes);
}

$sql_total = "SELECT COUNT(*) AS total FROM colaboradores {$filtro}";
$resultado_total = pg_query($conexao, $sql_total);
$total_registros = 0;
if ($resultado_total) {
    $dados_total = pg_fetch_assoc($resultado_total);
    $total_registros = (int) $dados_total['total'];
}
$total_paginas = ($total_registros > 0) ? ceil($total_registros / $itens_por_pagina) : 1;

$sql = "SELECT * FROM colaboradores {$filtro} ORDER BY nome ASC LIMIT {$itens_por_pagina} OFFSET {$offset}";
$resultado = pg_query($conexao, $sql);
$mensagem = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="cabecalho-pagina faixa-clara">
    <h2>Consulta de Colaboradores</h2>
    <p>Pesquise por nome, setor ou e-mail e refine pela situação.</p>
</div>

<div class="conteudo-box">
    <div class="barra-listagem barra-v2">
        <form action="listagem.php" method="get" class="form-busca busca-v2">
            <input type="text" name="busca" value="<?php echo htmlspecialchars($busca); ?>" placeholder="Buscar colaborador">
            <select name="situacao">
                <option value="">Todas as situações</option>
                <option value="Ativo" <?php echo ($filtro_situacao == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="Férias" <?php echo ($filtro_situacao == 'Férias') ? 'selected' : ''; ?>>Férias</option>
                <option value="Inativo" <?php echo ($filtro_situacao == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
            </select>
            <button type="submit" class="botao botao-primario">Filtrar</button>
            <a href="cadastro.php" class="botao botao-link">Novo Cadastro</a>
        </form>
    </div>

    <?php if ($mensagem != '') { ?>
        <div class="mensagem sucesso"><?php echo htmlspecialchars($mensagem); ?></div>
    <?php } ?>

    <table class="tabela-listagem tabela-v2">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Setor</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && pg_num_rows($resultado) > 0) { ?>
                <?php while ($linha = pg_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($linha['id']); ?></td>
                        <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                        <td><?php echo htmlspecialchars($linha['setor']); ?></td>
                        <td><?php echo htmlspecialchars($linha['email']); ?></td>
                        <td>
                            <span class="badge <?php echo strtolower(str_replace('é','e',$linha['situacao'])); ?>">
                                <?php echo htmlspecialchars($linha['situacao']); ?>
                            </span>
                        </td>
                        <td class="acoes-tabela">
                            <a href="visualizar.php?id=<?php echo $linha['id']; ?>" title="Visualizar">🔍</a>
                            <a href="cadastro.php?id=<?php echo $linha['id']; ?>" title="Editar">✏️</a>
                            <a href="excluir.php?id=<?php echo $linha['id']; ?>" title="Excluir" onclick="return confirm('Confirma a exclusão deste colaborador?');">🗑️</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" class="sem-registros">Nenhum colaborador localizado.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="paginacao">
        <?php if ($pagina > 1) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&situacao=<?php echo urlencode($filtro_situacao); ?>&pagina=<?php echo ($pagina - 1); ?>">&laquo; Voltar</a>
        <?php } ?>

        <?php $i = 1; while ($i <= $total_paginas) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&situacao=<?php echo urlencode($filtro_situacao); ?>&pagina=<?php echo $i; ?>" class="<?php echo ($i == $pagina) ? 'ativo' : ''; ?>"><?php echo $i; ?></a>
        <?php $i++; } ?>

        <?php if ($pagina < $total_paginas) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&situacao=<?php echo urlencode($filtro_situacao); ?>&pagina=<?php echo ($pagina + 1); ?>">Avançar &raquo;</a>
        <?php } ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
