<?php
include 'includes/header.php';
require_once 'config/Database.php';
require_once 'models/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$sucesso = false;
$erro = "";

if($_POST){
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];
    $produto->quantidade = $_POST['quantidade'];

    if($produto->criar()){
        $sucesso = true;
    } else {
        $erro = "Erro ao cadastrar produto.";
    }
}
?>
<div class="glass-card animate__animated animate__fadeInUp">
    <h2 class="mb-4">Cadastrar Produto</h2>
    
    <?php if($erro): ?>
        <div class="alert alert-danger animate__animated animate__shakeX"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post" class="animate__animated animate__fadeIn">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control bg-dark text-white border-0" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control bg-dark text-white border-0"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control bg-dark text-white border-0" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Quantidade</label>
        <input type="number" name="quantidade" class="form-control bg-dark text-white border-0" required>
      </div>
      <button type="submit" class="btn btn-grad btn-lg w-100">Salvar Produto</button>
    </form>
</div>

<?php if($sucesso): ?>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
  // Confetes inspirados no Homem-Aranha: vermelho, azul e branco
  const SPIDER_COLORS = ['#e50914', '#0a84ff', '#ffffff'];

  function webShooterLeft() {
    confetti({
      particleCount: 80,
      angle: 60,            // dispara em diagonal para cima
      spread: 60,
      origin: { x: 0.05, y: 0.95 }, // canto inferior esquerdo
      startVelocity: 55,
      gravity: 0.9,
      ticks: 200,
      colors: SPIDER_COLORS,
      shapes: ['square', 'circle'],
      scalar: 1
    });
  }

  function webShooterRight() {
    confetti({
      particleCount: 80,
      angle: 120,           // dispara em diagonal para cima
      spread: 60,
      origin: { x: 0.95, y: 0.95 }, // canto inferior direito
      startVelocity: 55,
      gravity: 0.9,
      ticks: 200,
      colors: SPIDER_COLORS,
      shapes: ['square', 'circle'],
      scalar: 1
    });
  }

  function centralBurst() {
    confetti({
      particleCount: 150,
      spread: 120,
      origin: { x: 0.5, y: 0.65 }, // um pouco acima do centro vertical
      startVelocity: 45,
      gravity: 0.8,
      ticks: 220,
      colors: SPIDER_COLORS,
      shapes: ['square', 'circle'],
      scalar: 1.1
    });
  }

  function trailingStream(durationMs = 1200) {
    const end = Date.now() + durationMs;
    (function frame() {
      confetti({
        particleCount: 12,
        startVelocity: 35,
        spread: 70,
        origin: { x: Math.random() * 0.6 + 0.2, y: 0.9 }, // faixa central inferior
        gravity: 1.0,
        ticks: 160,
        colors: SPIDER_COLORS,
        shapes: ['circle'],
        scalar: 0.9
      });
      if (Date.now() < end) requestAnimationFrame(frame);
    })();
  }

  window.onload = () => {
    // Sequência: esquerda -> direita -> burst central -> rastro
    webShooterLeft();
    setTimeout(webShooterRight, 150);
    setTimeout(centralBurst, 350);
    setTimeout(() => trailingStream(1400), 600);

    // Mensagem final com tema Spider-Man
    setTimeout(() => {
      alert("🕷️ Produto cadastrado com sucesso! Thwip! 🕸️");
    }, 1000);
  }
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>