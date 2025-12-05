<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Aba de Reclamação</title>
</head>
<body class="login-page">
    <div class="login-container">
        <form action="processa_reclamacao.php" method="POST">
            <div class="input-group">
                <label>Mensagem de reclamação:</label>
                <input type="text" name="msg_reclamacao" required>
            </div>
            <div class="select-group">
                <label>Setor:</label>
                <select name="setor_reclamacao">
                    <option value="1">Saúde</option>
                    <option value="2">Educação</option>
                    <option value="3">Economia</option>
                    <option value="4">Lazer</option>
                    <option value="5">Segurança</option>
                    <option value="6">Trânsito</option>
                </select>
            </div>
            <button type="submit" class="login-btn">Enviar Reclamação</button>
             <button onclick="history.back()" class="sac-btn voltar-btn">Voltar</button><p></p><p></p>
        </form>
    </div>
</body>
</html>
