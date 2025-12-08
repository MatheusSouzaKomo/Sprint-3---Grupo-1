<?php
session_start(); // Inicia a sessão para que o header possa acessar as variáveis de sessão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segurança - Guru's City</title>
    <script src="../main.js" defer></script>
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    // Usando __DIR__ para criar um caminho absoluto e robusto para os includes.
    // __DIR__ aponta para a pasta 'sectors', então usamos '/../' para subir um nível.
    include __DIR__ . '/../includes/header.php';
    ?>
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Segurança</h2>
        <p class="c-sector-page__description">Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
        
        <h3 class="c-sector-page__services-title">Serviços</h3>
        <div class="c-service-grid">
            <a href="#" class="c-card c-card--seguranca" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Drone</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
                </div>
            </a>
            <a href="#" class="c-card c-card--seguranca" style="animation: fadeInUp 0.5s ease-out 0.1s forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Alert</h4>
                    <p>Descrição breve do serviço ou feature 2.</p>
                </div>
            </a>
        </div>

        <!-- Funcionalidade Única: Alerta de Emergência -->
        <div class="c-feature-box">
            <h3 class="c-feature-box__title">Simulador de Alerta</h3>
            <p class="u-text-center">Clique no botão abaixo para simular o recebimento de um alerta de segurança em sua área.</p>
            <div class="u-text-center" style="margin-top: var(--space-4);">
                <button id="emergency-alert-btn" class="c-btn c-btn--danger">Ativar Alerta de Teste</button>
            </div>
            <div id="emergency-alert-banner" class="c-emergency-alert">
                <strong>ALERTA:</strong> Atividade suspeita reportada nas proximidades. Permaneça em local seguro. (Isto é um teste)
            </div>
        </div>
    </main>
    <?php include __DIR__ . '/../includes/footer.php';?>
</body>
</html>
