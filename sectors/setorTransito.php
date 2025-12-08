<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Trânsito - Guru's City</title>
    <script src="../main.js" defer></script>
=======
    <title>Setor de Trânsito</title>
    <script src="../theme.js"></script>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
<<<<<<< HEAD
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Trânsito</h2>
        <p class="c-sector-page__description">Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
        
        <h3 class="c-sector-page__services-title">Serviços</h3>
        <div class="c-service-grid">
            <a href="#" class="c-card c-card--transito" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Neo Street</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
=======
   <main class="sector" id="main-sector">
        <div class="container">
            <h2>Trânsito</h2>
            <p>Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
            <section class="sector-section" id="sector-service">
                <h3>Serviços</h3>
                <div class="flex flex-center">
                    <div class="item-service card-transito" onclick="location.href='setorSaude.php';">
                        <h4>Guru's Neo Street </h4>
                        <p>Descrição breve do serviço ou feature 2.</p>
                    </div>
                     <div class="item-service card-transito" onclick="location.href='setorSaude.php';">
                        <h4>Guru's Pole </h4>
                        <p>Descrição breve do serviço ou feature 2.</p>
                    </div>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
                </div>
            </a>
            <a href="#" class="c-card c-card--transito" style="animation: fadeInUp 0.5s ease-out 0.1s forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Pole</h4>
                    <p>Descrição breve do serviço ou feature 2.</p>
                </div>
            </a>
        </div>

        <!-- Funcionalidade Única: Simulador de Semáforo -->
        <div class="c-feature-box">
            <h3 class="c-feature-box__title">Simulador de Semáforo</h3>
            <div class="c-traffic-light">
                <div id="light-red" class="c-traffic-light__light c-traffic-light__light--red active"></div>
                <div id="light-yellow" class="c-traffic-light__light c-traffic-light__light--yellow"></div>
                <div id="light-green" class="c-traffic-light__light c-traffic-light__light--green"></div>
            </div>
            <div class="u-text-center">
                <button id="change-light-btn" class="c-btn c-btn--primary">Trocar Sinal</button>
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php';?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const changeBtn = document.getElementById('change-light-btn');
            const lights = {
                red: document.getElementById('light-red'),
                yellow: document.getElementById('light-yellow'),
                green: document.getElementById('light-green')
            };
            const states = ['red', 'green', 'yellow'];
            let currentStateIndex = 0;

            changeBtn.addEventListener('click', () => {
                lights[states[currentStateIndex]].classList.remove('active');
                currentStateIndex = (currentStateIndex + 1) % states.length;
                lights[states[currentStateIndex]].classList.add('active');
            });
        });
    </script>
</body>
</html>
