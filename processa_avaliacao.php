<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    $erro = "Você precisa estar logado para fazer uma avaliação.";
    $sucesso = false;
} else {
    $msg_avaliacao = $_POST['msg_avaliacao'];
    $id_usuario = $_SESSION['id_usuario'];
    $setor_avaliacao = $_POST['setor_avaliacao'];
    $nota_avaliacao = $_POST['nota_avaliacao'];

    $sql = "INSERT INTO avaliacao (msg_avaliacao, nota_avaliacao, setor_avaliacao, id_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $msg_avaliacao, $nota_avaliacao, $setor_avaliacao, $id_usuario);

    if ($stmt->execute()) {
        $sucesso = true;
        $mensagem = "Avaliação registrada com sucesso!";
    } else {
        $sucesso = false;
        $erro = "Erro ao registrar avaliação: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Avaliação - Resultado</title>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="alert <?php echo $sucesso ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($sucesso ? $mensagem : $erro); ?>
        </div>
        <a href="hub.php" class="botao-voltar" style="display: block; text-align: center; margin-top: 1.5rem;">Voltar ao Hub</a>
    </div>
    <button onclick="location.href='hub.php'" class="voltar-btn">Voltar</button>
</body>
</html>