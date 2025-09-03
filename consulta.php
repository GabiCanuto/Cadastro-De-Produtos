<?php
include 'includes/header.php';
require_once 'config/Database.php';
require_once 'models/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);
$result = $produto->listar();

// Mensagens via query string
$success = isset($_GET['success']) ? $_GET['success'] : '';
$error   = isset($_GET['error'])   ? $_GET['error']   : '';

// Carrega os resultados em memória e calcula total geral
$rows = [];
$totalGeral = 0.0;

if ($result) {
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
        // Normaliza tipos
        $r['preco'] = (float)$r['preco'];
        $r['quantidade'] = (int)$r['quantidade'];
        // Total por produto
        $r['total_produto'] = $r['preco'] * $r['quantidade'];
        $totalGeral += $r['total_produto'];
        $rows[] = $r;
    }
}
?>

<?php if($success): ?>
  <div class="alert alert-success animate__animated animate__fadeIn"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if($error): ?>
  <div class="alert alert-danger animate__animated animate__fadeIn"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="glass-card animate__animated animate__fadeInUp">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Produtos Cadastrados</h2>
        <a href="cadastro.php" class="btn btn-grad">Cadastrar novo</a>
    </div>

    <?php if (count($rows) === 0): ?>
        <div class="text-center py-5">
            <div class="mb-3" style="opacity:.9;">Nenhum produto encontrado.</div>
            <a href="cadastro.php" class="btn btn-grad">Cadastrar primeiro produto</a>
        </div>
    <?php else: ?>
        <div class="table-responsive animate__animated animate__fadeIn">
            <table class="table table-dark table-hover table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width:140px;">Preço</th>
                        <th style="width:140px;">Quantidade</th>
                        <th style="width:160px;">Total (R$)</th>
                        <th style="width:180px;">Data</th>
                        <th style="width:120px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr class="animate__animated animate__fadeInUp">
                            <td><?= (int)$row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= htmlspecialchars($row['descricao']) ?></td>
                            <td><span class="badge bg-success">R$ <?= number_format($row['preco'], 2, ',', '.') ?></span></td>
                            <td><?= (int)$row['quantidade'] ?></td>
                            <td><span class="badge bg-info">R$ <?= number_format($row['total_produto'], 2, ',', '.') ?></span></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['data_cadastro'])) ?></td>
                            <td class="action-icons">
                                <a href="editar.php?id=<?= (int)$row['id'] ?>" class="text-primary me-3" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="deletar.php?id=<?= (int)$row['id'] ?>" class="text-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Geral do Estoque:</th>
                        <th>
                            <span class="badge bg-warning text-dark">
                                R$ <?= number_format($totalGeral, 2, ',', '.') ?>
                            </span>
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>