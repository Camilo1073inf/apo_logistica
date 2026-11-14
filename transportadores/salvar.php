<?php
require "../config/conexao.php";

$id       = $_POST["id"] ?? "";
$nome     = trim($_POST["nome"]);
$cpf_cnpj = trim($_POST["cpf_cnpj"]);
$telefone = trim($_POST["telefone"]);
$cidade   = trim($_POST["cidade"]);

if ($id == "") {
    // Transportador novo
    $stmt = $pdo->prepare("INSERT INTO transportadores (nome, cpf_cnpj, telefone, cidade) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $cpf_cnpj, $telefone, $cidade]);
} else {
    // Transportador existente
    $stmt = $pdo->prepare("UPDATE transportadores SET nome = ?, cpf_cnpj = ?, telefone = ?, cidade = ? WHERE id = ?");
    $stmt->execute([$nome, $cpf_cnpj, $telefone, $cidade, $id]);
}

header("Location: index.php");
exit;