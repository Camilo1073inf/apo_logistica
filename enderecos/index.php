<?php
require "../config/conexao.php";
$pagina = "enderecos";
$titulo = "Endereços - Camilo Transportes";
$enderecos = $pdo->query("SELECT * FROM enderecos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
require "../includes/header.php";
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Endereços</h1>
    <a href="form.php" class="btn btn-danger">+ Novo endereço</a>
  </div>

  <?php if (isset($_GET["erro"])): ?>
    <div class="alert alert-warning">Esse endereço está em um frete e não pode ser excluído.</div>
  <?php endif; ?>

  <table class="table table-striped bg-white">
    <thead class="table-dark">
      <tr><th>ID</th><th>Rua</th><th>Nº</th><th>Complemento</th><th>Bairro</th><th>Cidade / UF</th><th>CEP</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach ($enderecos as $e): ?>
        <tr>
          <td><?= $e["id"] ?></td>
          <td><?= htmlspecialchars($e["rua"]) ?></td>
          <td><?= htmlspecialchars($e["numero"]) ?></td>
          <td><?= htmlspecialchars($e["complemento"] ?? "") ?></td>
          <td><?= htmlspecialchars($e["bairro"]) ?></td>
          <td><?= htmlspecialchars($e["cidade"]) ?> / <?= $e["estado"] ?></td>
          <td><?= htmlspecialchars($e["cep"]) ?></td>
          <td>
            <a href="form.php?id=<?= $e["id"] ?>" class="btn btn-sm btn-primary">Editar</a>
            <a href="excluir.php?id=<?= $e["id"] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Excluir este endereço?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require "../includes/footer.php"; ?>