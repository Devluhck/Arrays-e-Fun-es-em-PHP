<?php
// -------------------------------------------
// FUNÇÕES PERSONALIZADAS
// -------------------------------------------

// Função que verifica se um número é Par ou Ímpar
// Usa o operador % (módulo) para ver se há resto na divisão por 2
function verificar_par_impar($numero) {
    return ($numero % 2 === 0) ? "Par" : "Ímpar";
}

// Função que converte uma temperatura de Celsius para Fahrenheit
// Fórmula: (C × 9/5) + 32
function celsius_para_fahrenheit($celsius) {
    return ($celsius * 9 / 5) + 32;
}

// Função que verifica se um número é Primo
// Retorna "true" se o número for primo e "false" caso contrário
// Usa sqrt() para calcular a raiz quadrada e otimizar o cálculo
function verificar_primo($numero) {
    if ($numero <= 1) return false; // Números menores ou iguais a 1 não são primos
    for ($i = 2; $i <= sqrt($numero); $i++) { // Testa divisores até a raiz quadrada
        if ($numero % $i === 0) return false; // Se tiver divisor, não é primo
    }
    return true; // Se não encontrou divisor, é primo
}

// -------------------------------------------
// PROCESSAMENTO (POST)
// -------------------------------------------
// Essa parte é executada somente quando o formulário é enviado via método POST

$resultadoHtml = "";   // Variável que vai guardar o resultado em HTML
$codigoMostrado = "";  // Variável que vai guardar o código mostrado na tela (exemplo)

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // A função isset() verifica se a variável foi enviada (ou existe no formulário)
    // Se existir, converte o valor para o tipo adequado (int ou float)
    // Caso contrário, define como 0 (valor padrão)
    $numeroParImpar = isset($_POST["numeroParImpar"]) ? (int)$_POST["numeroParImpar"] : 0;
    $tempCelsius = isset($_POST["tempCelsius"]) ? (float)$_POST["tempCelsius"] : 0;
    $numeroPrimo = isset($_POST["numeroPrimo"]) ? (int)$_POST["numeroPrimo"] : 0;

    // Executa as funções criadas e armazena os resultados
    $resultadoParImpar = verificar_par_impar($numeroParImpar);
    $resultadoFahrenheit = celsius_para_fahrenheit($tempCelsius);
    $resultadoPrimo = verificar_primo($numeroPrimo) ? "Primo" : "Não primo";

    // -------------------------------------------
    // EXPLICAÇÃO SOBRE O BUFFER
    // -------------------------------------------
    // O "buffer" é uma área de memória temporária usada para guardar tudo
    // o que seria exibido na tela (com echo, print etc.) antes de realmente mostrar.
    // Assim, é possível montar o conteúdo completo e só exibir depois.

    // ob_start() → Inicia o buffer, dizendo ao PHP para "guardar" tudo que seria exibido
    ob_start();

    // A partir daqui, todos os "echo" vão ser gravados no buffer, e não exibidos ainda
    echo "<h2 class='section-title'>Resultados das Funções</h2>";
    echo "<div class='output'>";

    echo "<h3>1) Verificação Par/Ímpar</h3>";
    echo "<p>O número <strong>" . htmlspecialchars($numeroParImpar) . "</strong> é <strong>$resultadoParImpar</strong>.</p>";

    echo "<h3>2) Conversão Celsius → Fahrenheit</h3>";
    echo "<p><strong>" . number_format($tempCelsius, 2, ',', '.') . "°C</strong> equivale a <strong>" .
        number_format($resultadoFahrenheit, 2, ',', '.') . "°F</strong>.</p>";

    echo "<h3>3) Verificação de Número Primo</h3>";
    echo "<p>O número <strong>" . htmlspecialchars($numeroPrimo) . "</strong> é <strong>$resultadoPrimo</strong>.</p>";

    echo "</div>";

    // ob_get_clean() → Pega tudo o que foi guardado no buffer e apaga o conteúdo do buffer
    // Assim, o HTML gerado acima é armazenado dentro da variável $resultadoHtml
    // e não é mostrado diretamente na tela.
    $resultadoHtml = ob_get_clean();

    // Agora o conteúdo HTML completo está dentro de $resultadoHtml
    // e pode ser exibido, salvo, enviado por e-mail, inserido em um template, etc.

    // -------------------------------------------
    // Exemplo do código PHP mostrado na tela
    // -------------------------------------------
    $codigoMostrado = <<<'CODE'
<?php
function verificar_par_impar($numero) {
    return ($numero % 2 === 0) ? "Par" : "Ímpar";
}

function celsius_para_fahrenheit($celsius) {
    return ($celsius * 9 / 5) + 32;
}

function verificar_primo($numero) {
    if ($numero <= 1) return false;
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i === 0) return false;
    }
    return true;
}
?>
CODE;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Funções em PHP</title>

</head>

<body>
    <header>
        <a class="logo" href="index.php">Trabalho Arrays e Funções em PHP❄️</a>
        <?php include 'menu.php'; ?>
    </header>

    <main>
        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="container">
                <h1>Funções em PHP</h1>

                <div><?= $resultadoHtml ?></div>

                <?php if (!empty($codigoMostrado)): ?>
                    <h3 class="section-title">Trecho de código usado</h3>
                    <pre class="code-display"><?= htmlspecialchars($codigoMostrado) ?></pre>
                <?php endif; ?>

                <a class="back-link" href="funcao.php">Fazer outro teste</a>
                <a class="back-link" href="index.php" style="margin-left:10px;">Voltar para a Index</a>
            </div>

        <?php else: ?>

            <!-- CONTEÚDO EXPLICATIVO -->
            <section id="sobre" class="description">
                <h1>Funções em PHP</h1>
                <p>
                    Em PHP, uma <strong>função</strong> é um bloco de código reutilizável que executa uma tarefa específica.
                    Elas ajudam a <em>organizar</em>, <em>reaproveitar</em> e <em>modularizar</em> seu programa.
                </p>

                <p class="section-title">Vantagens do uso de funções:</p>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li>Evita repetição de código.</li>
                    <li>Facilita a manutenção e a leitura.</li>
                    <li>Pode receber parâmetros e retornar resultados.</li>
                </ul>

                <h2>Parâmetros e retorno de valores</h2>
                <p>Funções podem receber <em>parâmetros</em> (dados de entrada) e podem retornar um valor usando a palavra-chave <code>return</code>:</p>
                <pre class="code-display">
function soma($a, $b) {
    return $a + $b;
}
        </pre>
                <p>Exemplo: <code>echo soma(2, 3);</code> vai imprimir <strong>5</strong>.</p>

                <h2>Boas práticas no uso de funções</h2>
                <ul style="margin-left:18px; line-height:1.6; color:#4a4a4a;">
                    <li>Dê nomes claros e descritivos para as funções.</li>
                    <li>Mantenha as funções curtas e focadas em uma única tarefa.</li>
                    <li>Documente suas funções para explicar o que fazem, quais parâmetros recebem e o que retornam.</li>
                    <li>Evite efeitos colaterais (alterações inesperadas fora da função).</li>
                    <li>Use funções para evitar repetição de código.</li>
                </ul>
            </section>

            <!-- CONTEÚDO SOBRE FUNÇÕES -->
            <section id="funcoes" class="description">
                <h2>Funções nativas vs. funções do usuário</h2>
                <p><strong>Funções nativas</strong> são aquelas que o PHP já oferece, como:</p>
                <ul style="margin-left:18px; line-height:1.6;">
                    <li><code>strlen()</code> — conta caracteres de uma string</li>
                    <li><code>array_push()</code> — adiciona elemento(s) a um array</li>
                    <li><code>number_format()</code> — formata números</li>
                    <li><code>date()</code> — retorna a data atual</li>
                </ul>

                <p><strong>Funções criadas pelo usuário</strong> são escritas por você, por exemplo:</p>
                <pre class="code-display">function dobro($numero) {
    return $numero * 2;
}
echo dobro(5); // Isso vai imprimir 10
</pre>
            </section>

            <!-- PRÁTICA -->
            <section id="pratica" class="code-container">
                <h2 style="color:#1a1a1a; margin-bottom:15px;">Prática guiada</h2>

                <form action="funcao.php" method="post" style="margin-bottom:20px;">
                    <label>1) Número para verificação Par/Ímpar:</label>
                    <input type="number" name="numeroParImpar" required style="padding:10px; width:100%; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

                    <label>2) Temperatura em Celsius para converter:</label>
                    <input type="number" step="0.01" name="tempCelsius" required style="padding:10px; width:100%; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

                    <label>3) Número para verificar se é Primo:</label>
                    <input type="number" name="numeroPrimo" required style="padding:10px; width:100%; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

                    <div class="button-container">
                        <button type="submit">Executar Funções</button>
                    </div>
                </form>

                <a class="back-link" href="index.php" style="margin-top:20px; display:inline-block;">Voltar para a Index</a>
            </section>
        <?php endif; ?>
    </main>

    <footer></footer>
</body>

</html>