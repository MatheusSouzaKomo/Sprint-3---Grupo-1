<?php
require_once 'includes/config.php'; // Centraliza o início da sessão
require_once 'connection.php'; // Conexão com o banco

// Garante que o usuário esteja logado
if (!isset($_SESSION['id_usuario'])) {
<<<<<<< HEAD
    // Redireciona para a página de login com uma mensagem de erro
    header('Location: login.php?error=notloggedin');
    exit(); // Encerra o script
}

// Validação e Sanitização dos Dados
// Previne XSS na mensagem da reclamação
$msg_reclamacao = isset($_POST['msg_reclamacao']) ? htmlspecialchars(trim($_POST['msg_reclamacao']), ENT_QUOTES, 'UTF-8') : '';
$id_usuario = $_SESSION['id_usuario']; // ID vem da sessão, é seguro
$setor_reclamacao = isset($_POST['setor_reclamacao']) ? (int)$_POST['setor_reclamacao'] : 0; // Garante que seja um inteiro

if (empty($msg_reclamacao) || $setor_reclamacao <= 0) {
    die("Erro: Mensagem ou setor inválido.");
}

$sql = "INSERT INTO reclamacao (msg_reclamacao, setor_reclamacao, id_usuario) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $msg_reclamacao, $setor_reclamacao, $id_usuario); // "sii" estava correto

if ($stmt->execute()) {
    header('Location: hub.php?status=complaint_success');
} else {
    // Em produção, logar o erro em vez de exibi-lo ao usuário
    error_log("Erro ao registrar reclamação: " . $stmt->error);
    header('Location: hub.php?status=complaint_error');
}

$stmt->close();
$conn->close();
exit();
?>
=======
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
>>>>>>> cfdd3a026e6c4bf7132408c20428d0f9bf42b7fb
