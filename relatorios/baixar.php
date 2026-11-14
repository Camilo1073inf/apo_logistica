<?php
require "../config/conexao.php";
require "../includes/funcoes.php";

$data = $_GET["data"] ?? "";
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
    header("Location: index.php");
    exit;
}

$fretes = fretesDoDia($pdo, $data);

header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=relatorio_fretes_" . $data . ".csv");

echo "\xEF\xBB\xBF";
$saida = fopen("php://output", "w");

fputcsv($saida, ["ID", "Data", "Transportador", "Origem", "Destino", "Produtos", "Valor total (R$)"], ";", '"', "\\");

$total = 0;
foreach ($fretes as $f) {
    $total += $f["valor_total"];
    fputcsv($saida, [
        $f["id"],
        date("d/m/Y", strtotime($f["data_frete"])),
        $f["transportador"],
        $f["origem"],
        $f["destino"],
        $f["produtos"],
        number_format($f["valor_total"], 2, ",", ".")
    ], ";", '"', "\\");
}

fputcsv($saida, ["", "", "", "", "", "TOTAL DO DIA", number_format($total, 2, ",", ".")], ";", '"', "\\");
fclose($saida);
exit;