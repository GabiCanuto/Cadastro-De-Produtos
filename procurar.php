<?php
include 'includes/header.php';
require_once 'config/Database.php';
require_once 'models/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$rows = [];
$executou = false;

if ($q !== '') {
    $executou = true;
    $stmt = $produto->buscar($q);
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $r['preco'] = (float)$r['preco'];
        $r['quantidade'] = (int)$r['quantidade'];
        $r['total_produto'] = $r['preco'] * $r['quantidade'];
        $rows[] = $r;
    }
}
?>
<div class="glass-card animate__animated animate__fadeInUp">
    <h2 class="mb-4">Procurar Produto</h2>

    <form method="get" class="mb-4">
        <div class="row g-2">
            <div class="col-md-10">
                <input
                  type="text"
                  name="q"
                  class="form-control bg-dark text-white"
                  placeholder="Digite o nome ou descrição..."
                  value="<?= htmlspecialchars($q) ?>"
                  autofocus
                  />
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-grad" type="submit">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <?php if ($q === '' && !$executou): ?>
        <p class="text-muted">Dica: pesquise por parte do nome ou descrição do produto.</p>
    <?php elseif ($executou && count($rows) === 0): ?>
        <div class="alert alert-warning animate__animated animate__fadeIn">Nenhum produto encontrado para "<?= htmlspecialchars($q) ?>".</div>
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
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>