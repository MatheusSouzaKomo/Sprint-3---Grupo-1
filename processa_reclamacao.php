<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    die("Você precisa estar logado para fazer uma reclamação.");
}

$msg_reclamacao = $_POST['msg_reclamacao'];
$id_usuario = $_SESSION['id_usuario'];
$setor_reclamacao = $_POST['setor_reclamacao'];

$sql = "INSERT INTO reclamacao (msg_reclamacao, setor_reclamacao, id_usuario) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $msg_reclamacao, $setor_reclamacao, $id_usuario);

if ($stmt->execute()) {
    echo "Reclamação registrada!";
} else {
    echo "Erro ao registrar reclamação." . $stmt->error;
}
?>