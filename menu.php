<?php
// PRIMEIRA PARTE
$produtos = [
    "Interruptor" => 25,
    "Tomada" => 8,
    "Cabo Flexível 2,5mm" => 40,
    "Disjuntor" => 5,
    "Fita Isolante" => 18,
    "Canaleta" => 12,
    "Chave Philips" => 4,
    "Lâmpada LED" => 30,
    "Extensão" => 7,
    "Adaptador T" => 11
];

// Recebe o valor digitado no filtro
$pesquisar = isset($_POST['pesquisar']) ? (int)$_POST['pesquisar'] : null;

// SEGUNDA PARTE
$somaEstoque = 0;
$qtnItem = 0;

foreach($produtos as $descricao => $estoque) {
    $somaEstoque += $estoque;
    $qtnItem++;
}

$media = $qtnItem > 0 ? $somaEstoque / $qtnItem : 0;

// TERCEIRA PARTE:
$produtosFiltrados = [];
if ($pesquisar !== null) {
    foreach ($produtos as $descricao => $qtd) {
        if ($qtd < $pesquisar) {
            $produtosFiltrados[$descricao] = $qtd;
        }
    }
} else {
    $produtosFiltrados = $produtos; // se não filtrou, mantém todos
}

// QUARTA PARTE
$itensGerais = count($produtos);
$qtnItemMinimo = 0;

if ($pesquisar !== null) {
    foreach ($produtos as $descricao => $estoque) {
        if ($estoque < $pesquisar) {
            $qtnItemMinimo++;
        }
    }
}

$porcentagemMinimo = $itensGerais > 0 ? ($qtnItemMinimo / $itensGerais) * 100 : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Estoque com Filtro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4" style="color: black;">Estoque de Produtos</h2>

        <!-- Tabela com todos os produtos -->
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $descricao => $quantidade): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($descricao) ?>
                            <?php if ($pesquisar !== null && $quantidade < $pesquisar): ?>
                                <span class="text-danger fw-bold ms-2">⚠ Repor estoque</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $quantidade ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- FILTRO -->
        <form method="post" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <input type="number" name="pesquisar" class="form-control text-center" placeholder="Estoque menor que" value="<?= htmlspecialchars($pesquisar) ?>">
                </div>
                <div class="col-sm-2 text-center">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- RESULTADOS - MÉDIA E ESTOQUE MÍNIMO -->
        <div class="mt-4">
            <div class="alert alert-info text-center">
                <strong>Média de estoque geral:</strong> <?= number_format($media, 2, ',', '.') ?>
            </div>

            <?php if ($pesquisar !== null): ?>
                <div class="alert alert-warning text-center">
                    <strong>Porcentagem de produtos abaixo do estoque mínimo (<?= htmlspecialchars($pesquisar) ?>):</strong>
                    <?= number_format($porcentagemMinimo, 2, ',', '.') ?>%
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
