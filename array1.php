<?php
// array1.php


// -------------------------------
// PROCESSAMENTO (POST)
// -------------------------------
$resultadoHtml = "";
$codigoMostrado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    // Exemplo de "base de dados" simples usando um array unidimensional
    $frutas = ["Maçã", "Banana", "Laranja", "Uva", "Manga"];
    $nomes  = ["Ana", "Bruno", "Carla", "Diego", "Ester"];

    if ($acao === "listar") {
        // Listar os itens do array (percorrendo com foreach)
        ob_start();
        echo "<h2 class='section-title'>Resultado: Lista de Frutas</h2>";
        echo "<ul>";
        foreach ($frutas as $f) {
            echo "<li>" . htmlspecialchars($f) . "</li>";
        }
        echo "</ul>";
        $resultadoHtml = ob_get_clean();

        // Mostra o trecho de código usado
        $codigoMostrado = <<<'CODE'
<?php
$frutas = ["Maçã", "Banana", "Laranja", "Uva", "Manga"];

echo "<ul>";
foreach ($frutas as $f) {
    echo "<li>" . htmlspecialchars($f) . "</li>";
}
echo "</ul>";
CODE;
    } elseif ($acao === "media") {
        // Calcular a média de 4 notas recebidas — sem funções "avançadas"
        // (somando manualmente e dividindo pela quantidade)
        $n1 = isset($_POST["n1"]) ? (float)$_POST["n1"] : 0;
        $n2 = isset($_POST["n2"]) ? (float)$_POST["n2"] : 0;
        $n3 = isset($_POST["n3"]) ? (float)$_POST["n3"] : 0;
        $n4 = isset($_POST["n4"]) ? (float)$_POST["n4"] : 0;

        // Guardamos as notas em um array unidimensional para percorrer e somar
        $notas = [$n1, $n2, $n3, $n4];

        $soma = 0;
        for ($i = 0; $i < 4; $i++) {
            $soma = $soma + $notas[$i];
        }
        $media = $soma / 4;

        $status = ($media >= 7) ? "Aprovado(a)" : "Reprovado(a)";

        ob_start();
        echo "<h2 class='section-title'>Resultado: Média de Notas</h2>";
        echo "<p>Notas informadas: " . htmlspecialchars($n1) . ", " . htmlspecialchars($n2) . ", " . htmlspecialchars($n3) . ", " . htmlspecialchars($n4) . "</p>";
        echo "<p><strong>Média:</strong> " . number_format($media, 2, ",", ".") . " — <strong>$status</strong></p>";
        $resultadoHtml = ob_get_clean();

        $codigoMostrado = <<<'CODE'
<?php
$n1 = (float)$_POST["n1"];
$n2 = (float)$_POST["n2"];
$n3 = (float)$_POST["n3"];
$n4 = (float)$_POST["n4"];

$notas = [$n1, $n2, $n3, $n4];

$soma = 0;
for ($i = 0; $i < 4; $i++) {
    $soma = $soma + $notas[$i];
}
$media = $soma / 4;

$status = ($media >= 7) ? "Aprovado(a)" : "Reprovado(a)";

echo "Média: " . $media . " — " . $status;
CODE;
    } elseif ($acao === "buscar") {
        // Buscar um nome dentro de um array — fazendo a busca manual (sem in_array)
        $alvo = trim($_POST["nome"] ?? "");
        $alvoSeguro = htmlspecialchars($alvo);

        $encontrou = false;
        foreach ($nomes as $n) {
            if (mb_strtolower($n) === mb_strtolower($alvo)) {
                $encontrou = true;
                break;
            }
        }

        ob_start();
        echo "<h2 class='section-title'>Resultado: Busca de Nome</h2>";
        if ($alvo === "") {
            echo "<p class='error output'>Digite um nome para buscar.</p>";
        } else if ($encontrou) {
            echo "<p class='output'>O nome <strong>{$alvoSeguro}</strong> foi encontrado na lista.</p>";
        } else {
            echo "<p class='output'>O nome <strong>{$alvoSeguro}</strong> <em>não</em> foi encontrado na lista.</p>";
        }
        $resultadoHtml = ob_get_clean();

        $codigoMostrado = <<<'CODE'
<?php
$nomes = ["Ana", "Bruno", "Carla", "Diego", "Ester"];
$alvo = trim($_POST["nome"] ?? "");

$encontrou = false;
foreach ($nomes as $n) {
    if (mb_strtolower($n) === mb_strtolower($alvo)) {
        $encontrou = true;
        break;
    }
}

if ($encontrou) {
    echo "Encontrado!";
} else {
    echo "Não encontrado.";
}
CODE;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arrays Unidimensionais em PHP</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <a class="logo" href="index.php">Trabalho Arrays e Funções em PHP❄️</a>
        <?php include 'menu.php'; ?>
    </header>

    <main>
        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="container">
                <h1>Arrays unidimensionais (Vetores)</h1>

                <div class="output">
                    <?= $resultadoHtml ?>
                </div>

                <?php if (!empty($codigoMostrado)): ?>
                    <h3 class="section-title">Trecho de código usado</h3>
                    <pre class="code-display"><?= htmlspecialchars($codigoMostrado) ?></pre>
                <?php endif; ?>

                <a class="back-link" href="array1.php">Fazer outro teste</a>
                <a class="back-link" href="index.php" style="margin-left:10px;">Voltar para a Index</a>
            </div>
        <?php else: ?>
            <!-- CONTEÚDO EXPLICATIVO -->
            <section id="sobre" class="description">
                <h1>Arrays unidimensionais (Vetores) em PHP</h1>
                <p style="margin-top:10px;">
                    Um <strong>array unidimensional</strong> (também chamado de <em>vetor</em>) é uma estrutura que guarda
                    vários valores em uma única variável, acessados por um <strong>índice numérico</strong> que começa em 0.
                </p>
                <p class="section-title">Por que isso é importante?</p>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li><strong>Organização de dados:</strong> em vez de criar <em>várias</em> variáveis (fruta1, fruta2, fruta3…), você guarda tudo em uma só.</li>
                    <li><strong>Percorrer com laços:</strong> usar <code>for</code> ou <code>foreach</code> para listar, somar e tratar dados facilmente.</li>
                    <li><strong>Operações comuns:</strong> contar elementos, calcular média, buscar um item, filtrar e ordenar.</li>
                    <li><strong>Base para evoluir:</strong> entender vetores facilita aprender arrays bidimensionais e trabalhar com dados vindos de formulários, arquivos e banco de dados.</li>
                    <li><strong>Menos repetição de código:</strong> você escreve uma lógica única que funciona para N elementos.</li>
                </ul>
            </section>

            <!-- “Funções” (na prática, operações básicas com arrays) -->
            <section id="funcoes" class="description">
                <p class="section-title">Conceitos que você vai treinar abaixo</p>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li>Declaração de array: <code>$frutas = ["Maçã", "Banana"];</code></li>
                    <li>Percorrer com <code>foreach</code> e <code>for</code></li>
                    <li>Somar valores manualmente</li>
                    <li>Busca simples percorrendo o array</li>
                </ul>
            </section>

            <!-- DEMOS PRÁTICAS -->
            <section id="pratica" class="code-container">
                <h2 style="color:#1a1a1a; margin-bottom:15px;">Prática guiada</h2>

                <!-- 1) Listar itens de um array -->
                <form action="array1.php" method="post" style="margin-bottom:20px;">
                    <input type="hidden" name="acao" value="listar">
                    <label>1) Listar uma lista de frutas (array unidimensional):</label>
                    <div class="button-container">
                        <button type="submit">Listar frutas</button>
                    </div>
                </form>

                <!-- 2) Média de notas usando um array -->
                <form action="array1.php" method="post" style="margin-bottom:20px;">
                    <input type="hidden" name="acao" value="media">
                    <label>2) Calcular a média de 4 notas usando um array:</label>
                    <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:10px; margin:10px 0 15px;">
                        <input type="number" name="n1" step="0.01" placeholder="Nota 1" required>
                        <input type="number" name="n2" step="0.01" placeholder="Nota 2" required>
                        <input type="number" name="n3" step="0.01" placeholder="Nota 3" required>
                        <input type="number" name="n4" step="0.01" placeholder="Nota 4" required>
                    </div>
                    <div class="button-container">
                        <button type="submit">Calcular média</button>
                    </div>
                </form>

                <!-- 3) Buscar nome em um array -->
                <form action="array1.php" method="post">
                    <input type="hidden" name="acao" value="buscar">
                    <label>3) Buscar um nome na lista (sem usar in_array, busca manual):</label>
                    <div style="display:flex; gap:10px; margin:10px 0 15px; flex-wrap:wrap;">
                        <input type="text" name="nome" placeholder="Digite um nome (ex.: Ana, Bruno, Carla)" style="flex:1; min-width:220px;">
                    </div>
                    <div class="button-container">
                        <button type="submit">Buscar</button>
                    </div>
                </form>

                <a class="back-link" href="index.php" style="margin-top:20px; display:inline-block;">Voltar para a Index</a>
            </section>
        <?php endif; ?>
    </main>

    <footer></footer>
</body>

</html>