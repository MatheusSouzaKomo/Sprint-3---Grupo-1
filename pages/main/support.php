<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/boilerplate.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Document</title>
</head>
<?php include '../../includes/header.php'; ?>
<body class="o-page-container">
    <div class="c-login-box">
        <h2 class="c-login-box__title">Enviar Reclamação</h2>
        <form action="processa_reclamacao.php" method="POST" class="c-login-box__form">
            <div class="c-form-field">
                <label for="msg_reclamacao" class="c-form-field__label">Mensagem de reclamação:</label>
                <textarea id="msg_reclamacao" name="msg_reclamacao" class="c-form-field__input" rows="4" required></textarea>
            </div>
            <div class="c-form-field">
                <label for="setor_reclamacao" class="c-form-field__label">Setor:</label>
                <select name="setor_reclamacao" id="setor_reclamacao" class="c-form-field__input">
                    <option value="1">Saúde</option>
                    <option value="2">Educação</option>
                    <option value="3">Economia</option>
                    <option value="4">Lazer</option>
                    <option value="5">Segurança</option>
                    <option value="6">Trânsito</option>
                </select>
            </div>
            <button type="submit" class="c-btn c-btn--primary" style="width: 100%; margin-top: var(--space-4);">Enviar Reclamação</button>
        </form>
    </div>
    <script src="../../assets/js/script.js"></script>
</body>
</html>
    
