<?php
require "../config/conexao.php";
$pagina = "enderecos";
$titulo = "Endereço - Camilo Transportes";

$estados = ["AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];

// Valores vazios, para quando for um endereço novo
$e = ["id" => "", "rua" => "", "numero" => "", "complemento" => "", "bairro" => "", "cidade" => "", "estado" => "", "cep" => ""];

// Se veio um id na URL, busca o endereço para editar
if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM enderecos WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $achado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($achado) { $e = $achado; }
}
require "../includes/header.php";
?>

<div class="container py-4">
  <h1><?= $e["id"] ? "Editar endereço" : "Novo endereço" ?></h1>
  <p class="text-muted">O mesmo cadastro serve para origem e destino dos fretes.</p>

  <form action="salvar.php" method="post" class="card p-4 mt-3">
    <input type="hidden" name="id" value="<?= $e["id"] ?>">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Rua</label>
        <input type="text" name="rua" class="form-control" value="<?= htmlspecialchars($e["rua"]) ?>" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Número</label>
        <input type="text" name="numero" class="form-control" value="<?= htmlspecialchars($e["numero"]) ?>" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Complemento (opcional)</label>
        <input type="text" name="complemento" class="form-control" value="<?= htmlspecialchars($e["complemento"] ?? "") ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Bairro</label>
        <input type="text" name="bairro" class="form-control" value="<?= htmlspecialchars($e["bairro"]) ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Cidade</label>
        <input type="text" name="cidade" class="form-control" value="<?= htmlspecialchars($e["cidade"]) ?>" required>
      </div>
      <div class="col-md-2">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
          <option value="">Selecione</option>
          <?php foreach ($estados as $uf): ?>
            <option value="<?= $uf ?>" <?= $e["estado"] == $uf ? "selected" : "" ?>><?= $uf ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">CEP</label>
        <input type="text" name="cep" class="form-control" value="<?= htmlspecialchars($e["cep"]) ?>" required>
      </div>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-danger">Salvar endereço</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>

<?php require "../includes/footer.php"; ?>