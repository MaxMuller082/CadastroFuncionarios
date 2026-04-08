<?php
require_once 'conexao.php';
$pagina_ativa = 'cadastro';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$colaborador = array(
    'id' => '',
    'nome' => '',
    'setor' => '',
    'email' => '',
    'telefone' => '',
    'situacao' => 'Ativo'
);
$titulo = 'Novo Colaborador';

if ($id > 0) {
    $sql = "SELECT * FROM colaboradores WHERE id = {$id} LIMIT 1";
    $resultado = pg_query($conexao, $sql);

    if ($resultado && pg_num_rows($resultado) == 1) {
        $colaborador = pg_fetch_assoc($resultado);
        $titulo = 'Editar Colaborador';
    }
}

$mensagem = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="cabecalho-pagina faixa-clara">
    <h2><?php echo $titulo; ?></h2>
    <p>Preencha os dados do colaborador e confirme para salvar.</p>
</div>

<div class="conteudo-box">
    <div class="box-formulario formato-v2">
        <div class="box-titulo destaque-v2">
            <span class="icone-box">🗂️</span>
            <h3>Ficha de Colaborador</h3>
        </div>

        <?php if ($mensagem != '') { ?>
            <div class="mensagem sucesso"><?php echo htmlspecialchars($mensagem); ?></div>
        <?php } ?>

        <form action="salvar.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($colaborador['id']); ?>">

            <div class="grid-formulario grid-v2">
                <div class="grupo-campo largura-total">
                    <label>Nome completo</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($colaborador['nome']); ?>" placeholder="Digite o nome completo" required>
                </div>

                <div class="grupo-campo">
                    <label>Setor</label>
                    <select name="setor" required>
                        <option value="">Selecione</option>
                        <option value="Administrativo" <?php echo ($colaborador['setor'] == 'Administrativo') ? 'selected' : ''; ?>>Administrativo</option>
                        <option value="Financeiro" <?php echo ($colaborador['setor'] == 'Financeiro') ? 'selected' : ''; ?>>Financeiro</option>
                        <option value="Operacional" <?php echo ($colaborador['setor'] == 'Operacional') ? 'selected' : ''; ?>>Operacional</option>
                        <option value="RH" <?php echo ($colaborador['setor'] == 'RH') ? 'selected' : ''; ?>>RH</option>
                    </select>
                </div>

                <div class="grupo-campo">
                    <label>Situação</label>
                    <select name="situacao" required>
                        <option value="Ativo" <?php echo ($colaborador['situacao'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="Férias" <?php echo ($colaborador['situacao'] == 'Férias') ? 'selected' : ''; ?>>Férias</option>
                        <option value="Inativo" <?php echo ($colaborador['situacao'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>

                <div class="grupo-campo">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($colaborador['email']); ?>" placeholder="nome@empresa.com" required>
                </div>

                <div class="grupo-campo">
                    <label>Telefone</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($colaborador['telefone']); ?>" placeholder="(61) 99999-0000" required>
                </div>
            </div>

            <div class="acoes-formulario alinhado-esquerda">
                <button type="submit" class="botao botao-primario">Gravar</button>
                <button type="reset" class="botao">Limpar Campos</button>
                <a href="listagem.php" class="botao botao-link">Consultar</a>
            </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
