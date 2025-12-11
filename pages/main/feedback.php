<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Formulário de Avaliação</title>
   <link rel="stylesheet" href="../../assets/css/boilerplate.css">
   <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="o-page-container">
    <div class="c-login-box">
        <h2 class="c-login-box__title">Deixe sua Avaliação</h2>
        <form action="../../actions/auth_feedback.php" method="POST" class="c-login-box__form">
            <div class="c-form-field">
                <label for="msg_avaliacao" class="c-form-field__label">Mensagem de avaliação:</label>
                <textarea id="msg_avaliacao" name="msg_avaliacao" class="c-form-field__input" rows="4" style="resize: none;" required></textarea>
           </div>
            <div class="c-form-field">
                <label for="setor_avaliacao" class="c-form-field__label">Setor:</label>
                <select id="setor_avaliacao" name="setor_avaliacao" class="c-form-field__input" required>
                   <option value="1">Saúde</option>
                   <option value="2">Educação</option>
                   <option value="3">Economia</option>
                   <option value="4">Lazer</option>
                   <option value="5">Segurança</option>
                   <option value="6">Trânsito</option>
               </select>
           </div>
            <div class="c-form-field">
                <label for="nota_avaliacao" class="c-form-field__label">Nota (1 a 5):</label>
                <select id="nota_avaliacao" name="nota_avaliacao" class="c-form-field__input" required>
                   <option value="1">1 - Péssimo</option>
                   <option value="2">2 - Ruim</option>
                   <option value="3">3 - Regular</option>
                   <option value="4">4 - Bom</option>
                   <option value="5">5 - Excelente</option>
               </select>
           </div>
            <button type="submit" class="c-btn c-btn--primary" style="width: 100%;">Enviar Avaliação</button>
       </form>
       <div class="c-login-box__footer">
           <a href="hub.php" class="c-link">Voltar</a>
           <script src="../../assets/js/script.js"></script>
       </div>
   </div>
</body>