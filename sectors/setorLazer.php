<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setor de Lazer</title>
    <script src="../theme.js"></script>
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php';?>
    <main class="sector" id="main-sector">
        <div class="container">
            <h2>Lazer</h2>
            <p>A Guru's House é mais que um investimento, é uma promessa para o futuro. A certeza de uma boa aposentadoria, boa estadia e muitas risadas com seus entes queridos. Família em primeiro lugar!</p>
            <section class="sector-section" id="sector-service">
                <h3>Serviços</h3>
                <div class="flex flex-center">
                    <div class="item-service card-lazer" onclick="location.href='setorSaude.php';">
                        <h4>Guru's House</h4>
                        <p>Conforto, segurança e lazer. A Guru's House é melhor que casa de vó!</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include '../includes/footer.php';?>  
</body>
</html>
