<?php
session_start();
include 'connection.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM login WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // 1️⃣ verifica se é hash antigo (MD5)
    if (md5($senha) === $user["senha"]) {
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["nivel"] = $user["nivel_acesso"];
        header("Location: avaliacao.php");
        exit();
    }

    // 2️⃣ verifica se é hash novo (password_hash)
    if (password_verify($senha, $user["senha"])) {
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["nivel"] = $user["nivel_acesso"];
        header("Location: avaliacao.php");
        exit();
    }
}

echo "Email ou senha incorretos.";
?>
