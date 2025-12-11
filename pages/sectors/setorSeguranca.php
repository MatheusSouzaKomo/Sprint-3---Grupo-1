<?php
session_start(); // Inicia a sessão para que o header possa acessar as variáveis de sessão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segurança - Guru's City</title>
    <link rel="stylesheet" href="../../assets/css/boilerplate.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php
    include '../../includes/header.php';
    ?>
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Segurança</h2>
        <div class="c-service-grid">
            <a href="../services/gurus_drone.html" class="c-card c-card--seguranca" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Drone</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
                </div>
            </a>
            <a href="../services/gurus_alert.html" class="c-card c-card--seguranca" style="animation: fadeInUp 0.5s ease-out 0.1s forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Alert</h4>
                    <p>Descrição breve do serviço ou feature 2.</p>
                </div>
            </a>
        </div>
    </main>
    <?php include '../../includes/footer.php';?>
    <script src="../../assets/js/script.js"></script>
</body>
</html>
