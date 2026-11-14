<?php
require "../config/conexao.php";

$id          = $_POST["id"] ?? "";
$rua         = trim($_POST["rua"]);
$numero      = trim($_POST["numero"]);
$complemento = trim($_POST["complemento"]);
$bairro      = trim($_POST["bairro"]);
$cidade      = trim($_POST["cidade"]);
$estado      = $_POST["estado"];
$cep         = trim($_POST["cep"]);

if ($id == "") {
    // Endereço novo
    $stmt = $pdo->prepare("INSERT INTO enderecos (rua, numero, complemento, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$rua, $numero, $complemento, $bairro, $cidade, $estado, $cep]);
} else {
    // Endereço existente
    $stmt = $pdo->prepare("UPDATE enderecos SET rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?");
    $stmt->execute([$rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $id]);
}

header("Location: index.php");
exit;