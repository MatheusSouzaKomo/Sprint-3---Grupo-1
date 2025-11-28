<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id_usuario'])) {
    die("Você precisa estar logado para fazer uma avaliação.");
}

$msg_avaliacao = $_POST['msg_avaliacao'];
$id_usuario = $_SESSION['id_usuario'];
$setor_avaliacao = $_POST['setor_avaliacao'];
$nota_avaliacao = $_POST['nota_avaliacao'];

$sql = "INSERT INTO avaliacao (msg_avaliacao, nota_avaliacao, setor_avaliacao, id_usuario) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siii", $msg_avaliacao, $nota_avaliacao, $setor_avaliacao, $id_usuario);

if ($stmt->execute()) {
    echo "Avaliação registrada!";
} else {
    echo "Erro ao registrar avaliação: " . $stmt->error;
}