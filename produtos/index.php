<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require "../config/conexao.php";
$pagina = "produtos";
$titulo = "Produtos - Camilo Transportes";
$produtos = $pdo->query("SELECT * FROM produtos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
require "../includes/header.php";
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Produtos</h1>
    <a href="form.php" class="btn btn-danger">+ Novo produto</a>
  </div>

  <?php if (isset($_GET["erro"])): ?>
    <div class="alert alert-warning">Esse produto está em um frete e não pode ser excluído.</div>
  <?php endif; ?>

  <table class="table table-striped bg-white">
    <thead class="table-dark">
      <tr><th>ID</th><th>Nome</th><th>Peso (kg)</th><th>Medidas</th><th>Quantidade</th><th>Valor</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach ($produtos as $p): ?>
        <tr>
          <td><?= $p["id"] ?></td>
          <td><?= htmlspecialchars($p["nome"]) ?></td>
          <td><?= $p["peso"] ?></td>
          <td><?= htmlspecialchars($p["medidas"] ?? "") ?></td>
          <td><?= $p["quantidade"] ?></td>
          <td>R$ <?= number_format($p["valor"], 2, ",", ".") ?></td>
          <td>
            <a href="form.php?id=<?= $p["id"] ?>" class="btn btn-sm btn-primary">Editar</a>
            <a href="excluir.php?id=<?= $p["id"] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Excluir este produto?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require "../includes/footer.php"; ?>