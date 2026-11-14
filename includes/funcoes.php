<?php
function fretesDoDia($pdo, $data) {
    $sql = "SELECT f.id, f.data_frete, t.nome AS transportador,
                   CONCAT(o.cidade, ' / ', o.estado) AS origem,
                   CONCAT(d.cidade, ' / ', d.estado) AS destino,
                   GROUP_CONCAT(CONCAT(p.nome, ' (', fp.quantidade, ')') SEPARATOR ', ') AS produtos,
                   SUM(p.valor * fp.quantidade) AS valor_total
            FROM fretes f
            JOIN transportadores t ON t.id = f.transportador_id
            JOIN enderecos o ON o.id = f.origem_id
            JOIN enderecos d ON d.id = f.destino_id
            LEFT JOIN frete_produtos fp ON fp.frete_id = f.id
            LEFT JOIN produtos p ON p.id = fp.produto_id
            WHERE f.data_frete = ?
            GROUP BY f.id, f.data_frete, t.nome, o.cidade, o.estado, d.cidade, d.estado
            ORDER BY f.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}