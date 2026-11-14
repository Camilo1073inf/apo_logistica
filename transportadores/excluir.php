<?php
require "../config/conexao.php";

try {
    $stmt = $pdo->prepare("DELETE FROM transportadores WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    header("Location: index.php");
} catch (PDOException $e) {
    header("Location: index.php?erro=1");
}
exit;