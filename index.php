<?php
require "config/conexao.php";
$pagina = "home";
$titulo = "Home - Camilo Transportes";
$enderecos = $pdo->query("SELECT id, rua, numero, cidade, estado FROM enderecos ORDER BY cidade, rua")->fetchAll(PDO::FETCH_ASSOC);
require "includes/header.php";
?>

<section class="hero">
  <div class="container">
    <h1 class="display-5 fw-bold">Gerenciador de Fretes</h1>
    <p class="lead">Cadastre produtos, endereços e transportadores; gere seus fretes em poucos cliques.</p>

    <div class="card painel-frete p-4">
      <h2 class="h4 mb-3">Gerar novo frete</h2>
      <form action="fretes/form.php" method="get" class="row g-3 align-items-end">
        <div class="col-md-5">
          <label class="form-label">Origem</label>
          <select name="origem" class="form-select">
            <option value="">Selecione o endereço de origem</option>
            <?php foreach ($enderecos as $e): ?>
              <option value="<?= $e["id"] ?>"><?= htmlspecialchars($e["rua"] . ", " . $e["numero"] . " - " . $e["cidade"] . "/" . $e["estado"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-5">
          <label class="form-label">Destino</label>
          <select name="destino" class="form-select">
            <option value="">Selecione o endereço de destino</option>
            <?php foreach ($enderecos as $e): ?>
              <option value="<?= $e["id"] ?>"><?= htmlspecialchars($e["rua"] . ", " . $e["numero"] . " - " . $e["cidade"] . "/" . $e["estado"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-danger w-100">Gerar</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>