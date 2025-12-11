<?php
session_start();
include '../connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha_atual = $_POST['senha_atual'] ?? '';
$nova_senha = $_POST['nova_senha'] ?? '';
$confirmar_senha = $_POST['confirmar_senha'] ?? '';

// Validação básica
if (empty($nome) || empty($email)) {
    header("Location: ../pages/main/profile.php?status=empty_fields");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../pages/main/profile.php?status=invalid_email");
    exit;
}

$params = [$nome, $email];
$types = "ss";
$sql = "UPDATE login SET nome = ?, email = ?";

// Lógica para alteração de senha
if (!empty($nova_senha)) {
    // 1. Senha atual é obrigatória se uma nova senha for fornecida
    if (empty($senha_atual)) {
        header("Location: ../pages/main/profile.php?status=current_pass_required");
        exit;
    }

    // 2. Buscar a senha atual no banco de dados
    $stmt_pass = $conn->prepare("SELECT senha FROM login WHERE id_usuario = ?");
    $stmt_pass->bind_param("i", $id_usuario);
    $stmt_pass->execute();
    $user = $stmt_pass->get_result()->fetch_assoc();

    // 3. Verificar se a senha atual corresponde
    if (!password_verify($senha_atual, $user['senha'])) {
        header("Location: ../pages/main/profile.php?status=wrong_current_pass");
        exit;
    }

    // 4. Verificar se a nova senha e a confirmação coincidem
    if ($nova_senha !== $confirmar_senha) {
        header("Location: ../pages/main/profile.php?status=pass_mismatch");
        exit;
    }

    // 5. Se tudo estiver correto, adicionar a nova senha à query
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $sql .= ", senha = ?";
    $params[] = $senha_hash;
    $types .= "s";
}

$sql .= " WHERE id_usuario = ?";
$params[] = $id_usuario;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    $_SESSION['nome'] = $nome; // Atualiza o nome na sessão
    header("Location: ../pages/main/profile.php?status=success");
} else {
    header("Location: ../pages/main/profile.php?status=update_error");
}
exit;