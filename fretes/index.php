<?php
require "../config/conexao.php";
$pagina = "fretes";
$titulo = "Fretes - Camilo Transportes";

$sql = "SELECT f.id, f.data_frete, t.nome AS transportador,
               CONCAT(o.cidade, ' / ', o.estado) AS origem,
               CONCAT(d.cidade, ' / ', d.estado) AS destino,
               GROUP_CONCAT(CONCAT(p.nome, ' (', fp.quantidade, ')') SEPARATOR ', ') AS produtos,
               SUM(p.valor * fp.quantidade) AS valor_total
        FROM fretes f
        JOIN transportadores t ON t.id = f.transportador_id
        JOIN enderecos o ON o.id = f.origem_id
        JOIN enderecos d ON d.id = f.destino_id
        LEFT JOIN frete_produtos fp ON fp.frete_id = f.id
        LEFT JOIN produtos p ON p.id = fp.produto_id
        GROUP BY f.id, f.data_frete, t.nome, o.cidade, o.estado, d.cidade, d.estado
        ORDER BY f.data_frete DESC, f.id DESC";
$fretes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
require "../includes/header.php";
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Fretes</h1>
    <a href="form.php" class="btn btn-danger">+ Gerar frete</a>
  </div>

  <table class="table table-striped bg-white">
    <thead class="table-dark">
      <tr><th>ID</th><th>Data</th><th>Transportador</th><th>Origem</th><th>Destino</th><th>Produtos</th><th>Valor</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach ($fretes as $f): ?>
        <tr>
          <td><?= $f["id"] ?></td>
          <td><?= date("d/m/Y", strtotime($f["data_frete"])) ?></td>
          <td><?= htmlspecialchars($f["transportador"]) ?></td>
          <td><?= htmlspecialchars($f["origem"]) ?></td>
          <td><?= htmlspecialchars($f["destino"]) ?></td>
          <td><?= htmlspecialchars($f["produtos"] ?? "") ?></td>
          <td>R$ <?= number_format($f["valor_total"] ?? 0, 2, ",", ".") ?></td>
          <td>
            <a href="excluir.php?id=<?= $f["id"] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Excluir este frete?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require "../includes/footer.php"; ?>