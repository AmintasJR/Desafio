
<?php


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


echo "<p>Estoque Geral<p>";

    /* PRIMEIRA PARTE */
foreach($produtos as $descricao => $estoque)
{
    echo"<p>Descricao: $descricao || Estoque: " . number_format($estoque, 2, ',','.') . "<p>";
};

echo "<hr>";
    /* SEGUNDA PARTE */

$somaEstoque = 0;
$qtnItem = 0;

foreach($produtos as $descricao => $estoque)
{
    $somaEstoque += $estoque;
    $qtnItem++;
};

$media = $somaEstoque / $qtnItem;
echo "<p> Media de Estoque<p>";
echo "<p> A soma do estoque todo ficou: " . $somaEstoque . "<p>";
echo "<p> A quantidade de produtos ficou: " . $qtnItem . "<p>";
echo "<p> A media ficou: " . $media . "<p>";



echo "<hr>";
    /* TERCEIRA PARTE */

    echo "<p> Produtos com estoque abaixo de 10.";
foreach($produtos as $descricao => $estoque)
{
    if ($estoque < 10) {
        echo "<p> Nome: " . $descricao . " || Estoque: " . $estoque . "<p>";  
    }
};

echo "<hr>";
     /* QUARTA PARTE */
echo "Porcentagem do produtos abaixo do estoque minimo";
$itensGerais = count($produtos);
$qtnItemMinimo = 0;
$porcentagemMinimo = 0;

foreach($produtos as $descricao => $estoque)
{
    if ($estoque < 10) {
    $qtnItemMinimo++;
    }
};
    $porcentagemMinimo = ($qtnItemMinimo / $itensGerais) * 100;
    echo"<p>" . $porcentagemMinimo . "% dos produtos estão abaixo do estoque minimo definido<p>";


echo "<hr>";

     /* QUINTA PARTE */
echo "<p>Estoque Geral com aviso<p>";
foreach($produtos as $descricao => $estoque)
{
    if ($estoque < 10)
    {
    echo"<p>Descricao: $descricao || Estoque: " . number_format($estoque, 2, ',','.') . " ⚠ Repor estoque <p>";
    }
    else {
        echo"<p>Descricao: $descricao || Estoque: " . number_format($estoque, 2, ',','.') . "</p>";
    }

};

echo "<hr>";


?>