<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Padrão de Setores</title>
    <script src="../theme.js"></script>
    <link rel="stylesheet" href="../css/boilerplate.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
   <main class="sector" id="main-sector">
        <div class="container">
            <h2>Saúde</h2>
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
                </div>
            </section>
        </div>
    </main>
    <?php include '../includes/footer.php';?>  
</body>
</html>
