<?php
include 'includes/header.php';
require_once 'config/Database.php';
require_once 'models/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: consulta.php?error=ID inválido");
    exit;
}

$id = (int) $_GET['id'];
$dados = $produto->findById($id);

if (!$dados) {
    header("Location: consulta.php?error=Produto não encontrado");
    exit;
}

$sucesso = false;
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto->id = $id;
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];
    $produto->quantidade = $_POST['quantidade'];

    if ($produto->atualizar()) {
        header("Location: consulta.php?success=Produto atualizado");
        exit;
    } else {
        $erro = 'Erro ao atualizar o produto.';
    }
}
?>
<div class="glass-card animate__animated animate__fadeInUp">
    <h2 class="mb-4">Editar Produto</h2>

    <?php if($erro): ?>
      <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post" class="animate__animated animate__fadeIn">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control bg-dark text-white border-0" required value="<?= htmlspecialchars($dados['nome']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control bg-dark text-white border-0"><?= htmlspecialchars($dados['descricao']) ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control bg-dark text-white border-0" required value="<?= htmlspecialchars($dados['preco']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Quantidade</label>
        <input type="number" name="quantidade" class="form-control bg-dark text-white border-0" required value="<?= htmlspecialchars($dados['quantidade']) ?>">
      </div>

      <div class="d-flex gap-2">
        <a href="consulta.php" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-grad">Salvar Alterações</button>
      </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>