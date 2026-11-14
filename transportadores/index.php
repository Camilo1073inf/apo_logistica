<?php
require "../config/conexao.php";
$pagina = "transportadores";
$titulo = "Transportadores - Camilo Transportes";
$transportadores = $pdo->query("SELECT * FROM transportadores ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
require "../includes/header.php";
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Transportadores</h1>
    <a href="form.php" class="btn btn-danger">+ Novo transportador</a>
  </div>

  <?php if (isset($_GET["erro"])): ?>
    <div class="alert alert-warning">Esse transportador está em um frete e não pode ser excluído.</div>
  <?php endif; ?>

  <table class="table table-striped bg-white">
    <thead class="table-dark">
      <tr><th>ID</th><th>Nome</th><th>CPF/CNPJ</th><th>Telefone</th><th>Cidade</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach ($transportadores as $t): ?>
        <tr>
          <td><?= $t["id"] ?></td>
          <td><?= htmlspecialchars($t["nome"]) ?></td>
          <td><?= htmlspecialchars($t["cpf_cnpj"]) ?></td>
          <td><?= htmlspecialchars($t["telefone"] ?? "") ?></td>
          <td><?= htmlspecialchars($t["cidade"] ?? "") ?></td>
          <td>
            <a href="form.php?id=<?= $t["id"] ?>" class="btn btn-sm btn-primary">Editar</a>
            <a href="excluir.php?id=<?= $t["id"] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Excluir este transportador?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require "../includes/footer.php"; ?>