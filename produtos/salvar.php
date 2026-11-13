<?php
require "../config/conexao.php";

$id         = $_POST["id"] ?? "";
$nome       = trim($_POST["nome"]);
$peso       = $_POST["peso"];
$medidas    = trim($_POST["medidas"]);
$quantidade = $_POST["quantidade"];
$valor      = $_POST["valor"];

if ($id == "") {
    // Produto novo
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, peso, medidas, quantidade, valor) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $peso, $medidas, $quantidade, $valor]);
} else {
    // Produto existente
    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, peso = ?, medidas = ?, quantidade = ?, valor = ? WHERE id = ?");
    $stmt->execute([$nome, $peso, $medidas, $quantidade, $valor, $id]);
}

header("Location: index.php");
exit;