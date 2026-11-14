<?php
require "../config/conexao.php";
$pagina = "fretes";
$titulo = "Gerar frete - Camilo Transportes";

$transportadores = $pdo->query("SELECT id, nome FROM transportadores ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$enderecos = $pdo->query("SELECT id, rua, numero, cidade, estado FROM enderecos ORDER BY cidade, rua")->fetchAll(PDO::FETCH_ASSOC);
$produtos = $pdo->query("SELECT id, nome FROM produtos ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$faltaCadastro = !$transportadores || count($enderecos) < 2 || !$produtos;
require "../includes/header.php";
?>

<div class="container py-4">
  <h1>Gerar frete</h1>

  <?php if ($faltaCadastro): ?>
    <div class="alert alert-warning mt-3">
      Para gerar um frete, cadastre antes pelo menos 1 transportador, 2 endereços (origem e destino) e 1 produto.
    </div>
  <?php endif; ?>

  <form action="salvar.php" method="post" class="card p-4 mt-3">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Data</label>
        <input type="date" name="data_frete" class="form-control" value="<?= date("Y-m-d") ?>" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Transportador</label>
        <select name="transportador_id" class="form-select" required>
          <option value="">Selecione o transportador</option>
          <?php foreach ($transportadores as $t): ?>
            <option value="<?= $t["id"] ?>"><?= htmlspecialchars($t["nome"]) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Origem</label>
        <select name="origem_id" id="origem" class="form-select" required>
          <option value="">Selecione o endereço de origem</option>
          <?php foreach ($enderecos as $e): ?>
            <option value="<?= $e["id"] ?>"><?= htmlspecialchars($e["rua"] . ", " . $e["numero"] . " - " . $e["cidade"] . "/" . $e["estado"]) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Destino</label>
        <select name="destino_id" id="destino" class="form-select" required>
          <option value="">Selecione o endereço de destino</option>
          <?php foreach ($enderecos as $e): ?>
            <option value="<?= $e["id"] ?>"><?= htmlspecialchars($e["rua"] . ", " . $e["numero"] . " - " . $e["cidade"] . "/" . $e["estado"]) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <h5 class="mt-4">Produtos do frete</h5>
    <div id="lista-produtos"></div>
    <button type="button" id="btn-add" class="btn btn-outline-danger btn-sm mt-2">+ Adicionar produto</button>

    <div class="mt-4">
      <button type="submit" class="btn btn-danger" <?= $faltaCadastro ? "disabled" : "" ?>>Gerar frete</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>

<template id="modelo-produto">
  <div class="row g-2 mb-2 linha-produto">
    <div class="col-8 col-md-8">
      <select name="produto_id[]" class="form-select" required>
        <option value="">Selecione o produto</option>
        <?php foreach ($produtos as $p): ?>
          <option value="<?= $p["id"] ?>"><?= htmlspecialchars($p["nome"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-3 col-md-3">
      <input type="number" name="quantidade[]" class="form-control" min="1" value="1" required>
    </div>
    <div class="col-1 col-md-1">
      <button type="button" class="btn btn-outline-secondary w-100 btn-remover">X</button>
    </div>
  </div>
</template>

<script>
  const lista = document.getElementById("lista-produtos");
  const modelo = document.getElementById("modelo-produto");

  function adicionarLinha() {
    lista.appendChild(modelo.content.cloneNode(true));
  }

  document.getElementById("btn-add").addEventListener("click", adicionarLinha);

  lista.addEventListener("click", function (ev) {
    if (ev.target.classList.contains("btn-remover")) {
      if (lista.children.length > 1) {
        ev.target.closest(".linha-produto").remove();
      }
    }
  });

  adicionarLinha();

  document.querySelector("form").addEventListener("submit", function (ev) {
    if (document.getElementById("origem").value === document.getElementById("destino").value) {
      alert("A origem e o destino precisam ser endereços diferentes.");
      ev.preventDefault();
    }
  });
</script>

<?php require "../includes/footer.php"; ?>