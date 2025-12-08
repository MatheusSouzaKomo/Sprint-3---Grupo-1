<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Economia - Guru's City</title>
    <script src="../main.js" defer></script>
=======
    <title>Setor Econômico</title>
    <script src="../theme.js"></script>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<<<<<<< HEAD
    <?php include '../includes/header.php'; ?>
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Economia</h2>
        <p class="c-sector-page__description">Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
        
        <h3 class="c-sector-page__services-title">Serviços</h3>
        <div class="c-service-grid">
            <a href="#" class="c-card c-card--economia" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Bank</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
=======
    <?php include '../includes/header.php';?>
    <main class="sector" id="main-sector">
        <div class="container">
            <h2>Economia</h2>
            <p>Se afilie a tecnologia do novo mundo, da cidade tecnológica! Com todos as transações, investimentos e previsões na palma da sua mão, nada há de se temer. Seu futuro está em boas mãos.</p>
            <section class="sector-section" id="sector-service">
                <h3>Serviços</h3>
                <div class="flex flex-center">
                    <div class="item-service card-economia" onclick="location.href='setorSaude.php';">
                        <h4>Guru's Bank</h4>
                        <p>Facilidade, transparência e segurança financeira. Isso e muito mais, na Guru's Bank!</p>
                    </div>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
                </div>
            </a>
            <!-- Adicione mais cards de economia aqui, se houver -->
        </div>

        <!-- Funcionalidade Única: Calculadora de Juros Simples -->
        <div class="c-feature-box">
            <h3 class="c-feature-box__title">Calculadora de Juros Simples</h3>
            <div class="c-calculator-grid">
                <div class="c-form-field">
                    <label for="principal" class="c-form-field__label">Valor Principal (R$):</label>
                    <input type="number" id="principal" class="c-form-field__input" placeholder="1000">
                </div>
                <div class="c-form-field">
                    <label for="taxa" class="c-form-field__label">Taxa de Juros (% ao mês):</label>
                    <input type="number" id="taxa" class="c-form-field__input" placeholder="1.5">
                </div>
                <div class="c-form-field">
                    <label for="tempo" class="c-form-field__label">Tempo (meses):</label>
                    <input type="number" id="tempo" class="c-form-field__input" placeholder="12">
                </div>
            </div>
            <div class="u-text-center" style="margin-top: var(--space-4);">
                <button id="calcular-juros-btn" class="c-btn c-btn--primary">Calcular Montante</button>
            </div>
            <p id="resultado-juros" class="c-calculator-result"></p>
        </div>
    </main>
    <?php include '../includes/footer.php';?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const calcularBtn = document.getElementById('calcular-juros-btn');
            const principalInput = document.getElementById('principal');
            const taxaInput = document.getElementById('taxa');
            const tempoInput = document.getElementById('tempo');
            const resultadoEl = document.getElementById('resultado-juros');

            calcularBtn.addEventListener('click', () => {
                const P = parseFloat(principalInput.value);
                const i = parseFloat(taxaInput.value) / 100; // Converte % para decimal
                const t = parseFloat(tempoInput.value);

                if (P > 0 && i > 0 && t > 0) {
                    const montante = P * (1 + i * t);
                    resultadoEl.textContent = `Montante Final: R$ ${montante.toFixed(2)}`;
                } else {
                    resultadoEl.textContent = 'Por favor, insira valores válidos.';
                }
            });
        });
    </script>
</body>
</html>
