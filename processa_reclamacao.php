<?php
require_once 'includes/config.php'; // Centraliza o início da sessão
require_once 'connection.php'; // Conexão com o banco

// Garante que o usuário esteja logado
if (!isset($_SESSION['id_usuario'])) {
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