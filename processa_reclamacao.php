<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    $erro = "Você precisa estar logado para fazer uma reclamação.";
    $sucesso = false;
} else {
    $msg_reclamacao = $_POST['msg_reclamacao'];
    $id_usuario = $_SESSION['id_usuario'];
    $setor_reclamacao = $_POST['setor_reclamacao'];

    $sql = "INSERT INTO reclamacao (msg_reclamacao, setor_reclamacao, id_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $msg_reclamacao, $setor_reclamacao, $id_usuario);

    if ($stmt->execute()) {
        $sucesso = true;
        $mensagem = "Reclamação registrada com sucesso!";
    } else {
        $sucesso = false;
        $erro = "Erro ao registrar reclamação: " . $stmt->error;
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
    <title>Reclamação - Resultado</title>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="alert <?php echo $sucesso ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($sucesso ? $mensagem : $erro); ?>
        </div>
        <a href="hub.php" class="botao-voltar" style="display: block; text-align: center; margin-top: 1.5rem;">Voltar ao Hub</a>
    </div>
</body>
</html>