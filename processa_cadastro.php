<?php
include 'connection.php';

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); 
    $nivel = $_POST["nivel_acesso"];

    $sql = "INSERT INTO login (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $nivel);

    if ($stmt->execute()) {
        header("Location: login.php"); // redireciona caso sucesso
        exit();
    } else {
        // Em caso de erro, renderiza uma página com header/footer para mostrar mensagem e botão Voltar
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="theme.js"></script>
            <link rel="stylesheet" href="css/style.css">
            <title>Cadastro - Erro</title>
        </head>
        <body class="login-page">
            <div class="login-container">
                <div class="alert error">Erro ao cadastrar: <?php echo htmlspecialchars($conn->error); ?></div>
                <button onclick="history.back()" class="voltar-btn">Voltar</button>
            </div>
        </body>
        </html>
        <?php
        exit();
    }
?>