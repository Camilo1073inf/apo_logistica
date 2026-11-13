<?php
$base = "/apo_logistica/";
if (!isset($pagina)) { $pagina = ""; }
if (!isset($titulo)) { $titulo = "Camilo Transportes"; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $titulo ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base ?>assets/css/estilo.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark barra-vermelha">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold" href="<?= $base ?>index.php">CAMILO TRANSPORTES</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link <?= $pagina == 'home' ? 'active' : '' ?>" href="<?= $base ?>index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= $pagina == 'produtos' ? 'active' : '' ?>" href="<?= $base ?>produtos/index.php">Produtos</a></li>
        <li class="nav-item"><a class="nav-link <?= $pagina == 'enderecos' ? 'active' : '' ?>" href="<?= $base ?>enderecos/index.php">Endereços</a></li>
        <li class="nav-item"><a class="nav-link <?= $pagina == 'transportadores' ? 'active' : '' ?>" href="<?= $base ?>transportadores/index.php">Transportadores</a></li>
        <li class="nav-item"><a class="nav-link <?= $pagina == 'fretes' ? 'active' : '' ?>" href="<?= $base ?>fretes/index.php">Fretes</a></li>
        <li class="nav-item"><a class="nav-link <?= $pagina == 'relatorios' ? 'active' : '' ?>" href="<?= $base ?>relatorios/index.php">Relatório</a></li>
      </ul>
    </div>
  </div>
</nav>