<?php
require "../config/conexao.php";

try {
    $stmt = $pdo->prepare("DELETE FROM enderecos WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    header("Location: index.php");
} catch (PDOException $e) {
    // Endereço usado em algum frete: o banco não deixa apagar
    header("Location: index.php?erro=1");
}
exit;