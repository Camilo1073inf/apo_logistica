<?php
require "../config/conexao.php";
$pagina = "produtos";
$titulo = "Produto - Camilo Transportes";

// Valores vazios, para quando for um produto novo
$p = ["id" => "", "nome" => "", "peso" => "", "medidas" => "", "quantidade" => 1, "valor" => ""];

// Se veio um id na URL, busca o produto para editar
if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $achado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($achado) { $p = $achado; }
}
require "../includes/header.php";
?>

<div class="container py-4">
  <h1><?= $p["id"] ? "Editar produto" : "Cadastro de produto" ?></h1>

  <form action="salvar.php" method="post" class="card p-4 mt-3">
    <input type="hidden" name="id" value="<?= $p["id"] ?>">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($p["nome"]) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Medidas</label>
        <input type="text" name="medidas" class="form-control" value="<?= htmlspecialchars($p["medidas"] ?? "") ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Peso (kg)</label>
        <input type="number" step="0.01" name="peso" class="form-control" value="<?= $p["peso"] ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Quantidade</label>
        <input type="number" name="quantidade" class="form-control" value="<?= $p["quantidade"] ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Valor do item (R$)</label>
        <input type="number" step="0.01" name="valor" class="form-control" value="<?= $p["valor"] ?>" required>
      </div>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-danger">Salvar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>

<?php require "../includes/footer.php"; ?>