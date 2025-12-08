<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazer - Guru's City</title>
    <script src="../main.js" defer></script>
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php';?>
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Lazer</h2>
        <p class="c-sector-page__description">Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
        
        <h3 class="c-sector-page__services-title">Serviços</h3>
        <div class="c-service-grid">
            <a href="#" class="c-card c-card--lazer" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's House</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
                </div>
            </a>
            <!-- Adicione mais cards de lazer aqui, se houver -->
        </div>

        <!-- Funcionalidade Única: Gerador de Atividade de Lazer -->
        <div class="c-feature-box">
            <h3 class="c-feature-box__title">Sugestão de Lazer</h3>
            <p class="u-text-center">Sem ideias do que fazer? Clique no botão para uma sugestão aleatória!</p>
            <div class="u-text-center" style="margin-top: var(--space-4);">
                <button id="activity-btn" class="c-btn c-btn--primary">Gerar Atividade</button>
            </div>
            <p id="activity-display" class="c-random-display" style="display: none;"></p>
        </div>
    </main>
    <?php include '../includes/footer.php';?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const activityBtn = document.getElementById('activity-btn');
            const activityDisplay = document.getElementById('activity-display');
            const activities = [
                "Ler um livro em um parque.",
                "Fazer uma caminhada na natureza.",
                "Visitar um museu local.",
                "Assistir a um filme clássico.",
                "Cozinhar uma nova receita."
            ];

            activityBtn.addEventListener('click', () => {
                const randomActivity = activities[Math.floor(Math.random() * activities.length)];
                activityDisplay.textContent = `Sugestão: ${randomActivity}`;
                activityDisplay.style.display = 'block';
            });
        });
    </script>
</body>
</html>
