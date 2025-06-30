<?php
$host = 'db'; // Nome do serviço MySQL no docker-compose
$dbname = 'botanica';
$user = 'user';
$pass = 'userpass123';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4;allowPublicKeyRetrieval=true";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Botânica do Cheiro</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    h1 { color: #2e7d32; }
    .produto { background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 0 8px #ccc; margin-bottom: 15px; }
    .nome { font-size: 1.2em; font-weight: bold; color: #333; }
    .descricao { margin-top: 5px; color: #666; }
    .preco { margin-top: 10px; color: #d32f2f; font-weight: bold; }
    .categoria { font-size: 0.9em; color: #888; }
  </style>
</head>
<body>
  <h1>Produtos - Botânica do Cheiro</h1>

  <?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
  <?php else: ?>
    <?php foreach ($produtos as $produto): ?>
      <div class="produto">
        <div class="nome"><?= htmlspecialchars($produto['nome']) ?></div>
        <div class="descricao"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></div>
        <div class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></div>
        <div class="categoria">Categoria: <?= $produto['categoria'] ?></div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</body>
</html>
