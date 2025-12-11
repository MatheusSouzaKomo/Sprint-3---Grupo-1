<?php
include '../connection.php'; // Conexão com o banco

// Garante que o usuário esteja logado
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$msg_reclamacao = isset($_POST['msg_reclamacao']) ? htmlspecialchars(trim($_POST['msg_reclamacao']), ENT_QUOTES, 'UTF-8') : '';
$id_usuario = $_SESSION['id_usuario']; 
$setor_reclamacao = isset($_POST['setor_reclamacao']) ? (int)$_POST['setor_reclamacao'] : 0; 

if (empty($msg_reclamacao) || $setor_reclamacao <= 0) {
    die("Erro: Mensagem ou setor inválido.");
}

$sql = "INSERT INTO reclamacao (msg_reclamacao, setor_reclamacao, id_usuario) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $msg_reclamacao, $setor_reclamacao, $id_usuario); 

if ($stmt->execute()) {
    header('Location: ../pages/main/hub.php?status=complaint_success');
} else {
 
    error_log("Erro ao registrar reclamação: " . $stmt->error);
    header('Location: ../pages/main/hub.php?status=complaint_error');
}

$stmt->close();
$conn->close();
exit();
?>

<div class="c-login-box__footer">
           <a href="../pages/main/hub.php" class="c-link">Voltar</a>
            </div>