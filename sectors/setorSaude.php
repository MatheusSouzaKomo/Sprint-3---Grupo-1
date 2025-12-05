<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setor de Saúde</title>
    <script src="../theme.js"></script>
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
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
                </div>
            </section>
        </div>
    </main>
    <?php include '../includes/footer.php';?>  
</body>
</html>
