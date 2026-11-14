<?php
require "../config/conexao.php";
$pagina = "transportadores";
$titulo = "Transportador - Camilo Transportes";

$t = ["id" => "", "nome" => "", "cpf_cnpj" => "", "telefone" => "", "cidade" => ""];

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM transportadores WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $achado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($achado) { $t = $achado; }
}
require "../includes/header.php";
?>

<div class="container py-4">
  <h1><?= $t["id"] ? "Editar transportador" : "Cadastro de transportador" ?></h1>

  <form action="salvar.php" method="post" class="card p-4 mt-3">
    <input type="hidden" name="id" value="<?= $t["id"] ?>">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($t["nome"]) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">CPF/CNPJ</label>
        <input type="text" name="cpf_cnpj" class="form-control" value="<?= htmlspecialchars($t["cpf_cnpj"]) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($t["telefone"] ?? "") ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Cidade</label>
        <input type="text" name="cidade" class="form-control" value="<?= htmlspecialchars($t["cidade"] ?? "") ?>">
      </div>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-danger">Salvar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>

<?php require "../includes/footer.php"; ?>