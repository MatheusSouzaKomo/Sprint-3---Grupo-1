<?php
session_start();
include '../connection.php';

// Proteção: apenas administradores podem acessar
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['nivel'] !== 'Administração') {
    header("Location: ../pages/main/hub.php");
    exit;
}

// Verifica se o ID do usuário foi enviado via POST
if (!isset($_POST['id_usuario']) || empty($_POST['id_usuario'])) {
    header("Location: admin_users.php?status=delete_error");
    exit;
}

$id_usuario = (int) $_POST['id_usuario'];

// Impede que o administrador delete a própria conta
if ($id_usuario === $_SESSION['id_usuario']) {
    header("Location: admin_users.php?status=self_delete_error");
    exit;
}

// Prepara a exclusão do usuário
$sql = "DELETE FROM login WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    header("Location: admin_users.php?status=user_deleted");
} else {
    header("Location: admin_users.php?status=delete_error");
}

exit;
?>
