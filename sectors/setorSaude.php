<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Saúde - Guru's City</title>
    <script src="../main.js" defer></script>
=======
    <title>Setor de Saúde</title>
    <script src="../theme.js"></script>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
<<<<<<< HEAD
    <main class="o-container c-sector-page u-text-center">
        <h2 class="c-sector-page__title">Saúde</h2>
        <p class="c-sector-page__description">Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
        
        <h3 class="c-sector-page__services-title">Serviços</h3>
        <div class="c-service-grid">
            <a href="#" class="c-card c-card--saude" style="animation: fadeInUp 0.5s ease-out forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Health & Care</h4>
                    <p>Descrição breve do serviço ou feature 1.</p>
=======
     <main class="sector" id="main-sector">
        <div class="container">
            <h2>Saúde</h2>
            <p>Como o futuro existe sem saúde? Sem cuidar ao próximo? Esse é o lema da Guru's. Com nossos projetos de saúde, temos o compromisso de manter nossa sociedade saudável e unida.</p>
            <section class="sector-section" id="sector-service">
                <h3>Serviços</h3>
                <div class="flex flex-center">
                    <div class="item-service card-saude" onclick="location.href='setorSaude.php';">
                        <h4>Guru's Health & Care</h4>
                        <p>Desde exames de rotina a cirurgias importantes. Você está seguro nas mãos da Guru's Health & Care.</p>
                    </div>
                    <div class="item-service card-saude" onclick="location.href='setorSaude.php';">
                        <h4>Guru's Mind</h4>
                        <p>Uma nova forma de hackear o próprio corpo. Venha viver o futuro de protéses com a Guru's Mind</p>
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
                </div>
            </a>
            <a href="#" class="c-card c-card--saude" style="animation: fadeInUp 0.5s ease-out 0.1s forwards;">
                <div class="c-card__content">
                    <h4 class="c-card__title">Guru's Mind</h4>
                    <p>Descrição breve do serviço ou feature 2.</p>
                </div>
            </a>
        </div>
    </main>
    <?php include '../includes/footer.php';?>  
</body>
</html>
