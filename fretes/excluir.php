<?php
require "../config/conexao.php";

$stmt = $pdo->prepare("DELETE FROM fretes WHERE id = ?");
$stmt->execute([$_GET["id"]]);

header("Location: index.php");
exit;