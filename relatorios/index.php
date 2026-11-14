<?php
require "../config/conexao.php";
require "../includes/funcoes.php";
$pagina = "relatorios";
$titulo = "Relatório - Camilo Transportes";

$data = $_GET["data"] ?? "";
$fretes = [];
$total = 0;
if ($data != "") {
    $fretes = fretesDoDia($pdo, $data);
    foreach ($fretes as $f) { $total += $f["valor_total"]; }
}
require "../includes/header.php";
?>

<div class="container py-4">
  <h1>Relatório de fretes</h1>

  <form method="get" class="card p-4 mt-3">
    <div class="row g-3 align-items-end">
      <div class="col-md-4">
        <label class="form-label">Data</label>
        <input type="date" name="data" class="form-control" value="<?= htmlspecialchars($data) ?>" required>
      </div>
      <div class="col-md-8">
        <button type="submit" class="btn btn-danger">Relatório do dia</button>
        <?php if ($data != "" && count($fretes) > 0): ?>
          <a href="baixar.php?data=<?= urlencode($data) ?>" class="btn btn-success">Baixar</a>
        <?php endif; ?>
      </div>
    </div>
  </form>

  <?php if ($data != ""): ?>
    <?php if (count($fretes) == 0): ?>
      <div class="alert alert-warning mt-4">Nenhum frete encontrado em <?= date("d/m/Y", strtotime($data)) ?>.</div>
    <?php else: ?>
      <table class="table table-striped bg-white mt-4">
        <thead class="table-dark">
          <tr><th>ID</th><th>Transportador</th><th>Origem</th><th>Destino</th><th>Produtos</th><th>Valor</th></tr>
        </thead>
        <tbody>
          <?php foreach ($fretes as $f): ?>
            <tr>
              <td><?= $f["id"] ?></td>
              <td><?= htmlspecialchars($f["transportador"]) ?></td>
              <td><?= htmlspecialchars($f["origem"]) ?></td>
              <td><?= htmlspecialchars($f["destino"]) ?></td>
              <td><?= htmlspecialchars($f["produtos"] ?? "") ?></td>
              <td>R$ <?= number_format($f["valor_total"] ?? 0, 2, ",", ".") ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr class="fw-bold">
            <td colspan="5" class="text-end">Total do dia</td>
            <td>R$ <?= number_format($total, 2, ",", ".") ?></td>
          </tr>
        </tfoot>
      </table>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php require "../includes/footer.php"; ?>