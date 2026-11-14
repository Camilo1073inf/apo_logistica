<?php
require "../config/conexao.php";

$data          = $_POST["data_frete"];
$transportador = $_POST["transportador_id"];
$origem        = $_POST["origem_id"];
$destino       = $_POST["destino_id"];
$produtos      = $_POST["produto_id"] ?? [];
$quantidades   = $_POST["quantidade"] ?? [];

if (count($produtos) == 0 || $origem == $destino) {
    header("Location: form.php");
    exit;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO fretes (data_frete, transportador_id, origem_id, destino_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data, $transportador, $origem, $destino]);
    $freteId = $pdo->lastInsertId();


    $stmt = $pdo->prepare("INSERT INTO frete_produtos (frete_id, produto_id, quantidade) VALUES (?, ?, ?)");
    foreach ($produtos as $i => $produtoId) {
        $stmt->execute([$freteId, $produtoId, $quantidades[$i]]);
    }

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    die("Erro ao gerar frete: " . $e->getMessage());
}

header("Location: index.php");
exit;