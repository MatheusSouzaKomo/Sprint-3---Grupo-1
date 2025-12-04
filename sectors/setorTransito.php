<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Padrão de Setores</title>
    <link rel="stylesheet" href="css/boilerplate.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main class="setor" id="setor-principal">
        <div class="container">
            <h2>Conteúdo Principal</h2>
            <p>Este é o setor principal do seu modelo. Ele pode conter subseções, artigos ou o conteúdo mais importante da página.</p>
            <section class="sub-setor" id="setor-servicos">
                <h3>Setor de Serviços/Features</h3>
                <div class="grid-3-colunas">
                    <div class="item-servico">
                        <h4>Serviço 1</h4>
                        <p>Descrição breve do serviço ou feature 1.</p>
                    </div>
                    <div class="item-servico">
                        <h4>Serviço 2</h4>
                        <p>Descrição breve do serviço ou feature 2.</p>
                    </div>
                    <div class="item-servico">
                        <h4>Serviço 3</h4>
                        <p>Descrição breve do serviço ou feature 3.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include 'includes/footer.php';?>  
</body>
</html>
