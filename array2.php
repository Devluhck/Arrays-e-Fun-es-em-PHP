<?php
$resultadoHtml = "";
$codigoMostrado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    // Exemplos de arrays bidimensionais

    // 1. Frutas com cores
    $frutas = [
        ["nome" => "Maçã", "cor" => "Vermelha"],
        ["nome" => "Banana", "cor" => "Amarela"],
        ["nome" => "Laranja", "cor" => "Laranja"],
        ["nome" => "Uva", "cor" => "Roxa"],
        ["nome" => "Manga", "cor" => "Amarela"]
    ];

    // 2. Notas de alunos (nome + 4 notas)
    $alunosNotas = [
        ["nome" => "Ana", "notas" => [7.5, 8.0, 6.0, 9.0]],
        ["nome" => "Bruno", "notas" => [5.0, 6.0, 7.0, 4.0]],
        ["nome" => "Carla", "notas" => [9.0, 9.5, 8.5, 10.0]],
        ["nome" => "Diego", "notas" => [6.0, 5.5, 7.0, 6.5]],
        ["nome" => "Ester", "notas" => [8.0, 7.5, 8.0, 9.0]],
    ];

    if ($acao === "listar") {
        // Listar frutas e cores
        ob_start();
        echo "<h2 class='section-title'>Lista de Frutas com Cores</h2>";
        echo "<ul>";

        foreach ($frutas as $fruta) {
            echo "<li>" . htmlspecialchars($fruta["nome"]) . " — Cor: " . htmlspecialchars($fruta["cor"]) . "</li>";
        }
        echo "</ul>";
        $resultadoHtml = ob_get_clean();

        $codigoMostrado = <<<'CODE'
            <?php
            $frutas = [
                ["nome" => "Maçã", "cor" => "Vermelha"],
                ["nome" => "Banana", "cor" => "Amarela"],
                // ...
            ];

            echo "<ul>";
            foreach ($frutas as $fruta) {
                echo "<li>" . htmlspecialchars($fruta["nome"]) . " — Cor: " . htmlspecialchars($fruta["cor"]) . "</li>";
            }
            echo "</ul>";
            CODE;
    } elseif ($acao === "media") {
        // Calcular média para cada aluno
        ob_start();
        echo "<h2 class='section-title'>Média das Notas dos Alunos</h2>";
        echo "<ul>";
        foreach ($alunosNotas as $aluno) {
            $soma = 0;
            $qtde = count($aluno["notas"]);
            for ($i = 0; $i < $qtde; $i++) {
                $soma += $aluno["notas"][$i];
            }
            $media = $soma / $qtde;
            $status = ($media >= 7) ? "Aprovado(a)" : "Reprovado(a)";
            echo "<li>" . htmlspecialchars($aluno["nome"]) . ": Média = " . number_format($media, 2, ",", ".") . " — <strong>$status</strong></li>";
        }
        echo "</ul>";
        $resultadoHtml = ob_get_clean();

        $codigoMostrado = <<<'CODE'
        <?php
        $alunosNotas = [
            ["nome" => "Ana", "notas" => [7.5, 8.0, 6.0, 9.0]],
            // ...
        ];

        foreach ($alunosNotas as $aluno) {
            $soma = 0;
            $qtde = count($aluno["notas"]);
            for ($i = 0; $i < $qtde; $i++) {
                $soma += $aluno["notas"][$i];
            }
            $media = $soma / $qtde;
            $status = ($media >= 7) ? "Aprovado(a)" : "Reprovado(a)";
            echo $aluno["nome"] . ": Média = " . $media . " — " . $status . "<br>";
        }
        CODE;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Arrays Bidimensionais em PHP</title>
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
                <h1>Arrays bidimensionais em PHP</h1>

                <div class="output">
                    <?= $resultadoHtml ?>
                </div>

                <?php if (!empty($codigoMostrado)): ?>
                    <h3 class="section-title">Trecho de código usado</h3>
                    <pre class="code-display"><?= htmlspecialchars($codigoMostrado) ?></pre>
                <?php endif; ?>

                <a class="back-link" href="array2.php">Fazer outro teste</a>
                <a class="back-link" href="index.php" style="margin-left:10px;">Voltar para a Index</a>
            </div>
        <?php else: ?>
            <section id="sobre" class="description">
                <h1>Arrays bidimensionais em PHP</h1>
                <p style="margin-top:10px;">
                    Um <strong>array bidimensional</strong> é um array onde cada elemento é outro array.
                    Isso permite armazenar dados relacionados em uma estrutura organizada, como uma tabela.
                </p>
                <p class="section-title">Por que isso é importante?</p>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li><strong>Organização de dados complexos:</strong> por exemplo, listas com múltiplas informações por registro.</li>
                    <li><strong>Facilidade para percorrer e processar dados:</strong> usando loops aninhados ou manipulação de arrays.</li>
                    <li><strong>Base para manipulação de dados tabulares, matrizes, ou informações estruturadas.</strong></li>
                </ul>
            </section>

            <section id="funcoes" class="description">
                <p class="section-title">Conceitos que você vai treinar abaixo</p>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li>Declaração de array bidimensional</li>
                    <li>Percorrer arrays com foreach e for aninhados</li>
                    <li>Calcular média com arrays dentro de arrays</li>
                    <li>Busca simples percorrendo o array multidimensional</li>
                </ul>
            </section>

            <section id="pratica" class="code-container">
                <h2 style="color:#1a1a1a; margin-bottom:15px;">Prática guiada</h2>

                <form action="array2.php" method="post" style="margin-bottom:20px;">
                    <input type="hidden" name="acao" value="listar" />
                    <label>1) Listar frutas e suas cores (array bidimensional):</label>
                    <div class="button-container">
                        <button type="submit">Listar frutas com cores</button>
                    </div>
                </form>

                <form action="array2.php" method="post" style="margin-bottom:20px;">
                    <input type="hidden" name="acao" value="media" />
                    <label>2) Calcular a média das notas de cada aluno:</label>
                    <div class="button-container">
                        <button type="submit">Calcular médias</button>
                    </div>
                </form>

                <a class="back-link" href="index.php" style="margin-top:20px; display:inline-block;">Voltar para a Index</a>
            </section>
        <?php endif; ?>
    </main>

    <footer></footer>
</body>

</html>