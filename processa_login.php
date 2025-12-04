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

    // 1️⃣ Verificação para senhas antigas com MD5
    if (md5($senha) === $user["senha"]) {

        // Define as variáveis de sessão
        $_SESSION["loggedin"] = true;
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["nivel"] = $user["nivel_acesso"];

        header("Location: hub.php"); // use sempre .php
        exit();
    }

    // 2️⃣ Verificação para senhas novas com password_hash()
    if (password_verify($senha, $user["senha"])) {

        // Define as variáveis de sessão
        $_SESSION["loggedin"] = true;
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["nivel"] = $user["nivel_acesso"];

        header("Location: hub.php");
        exit();
    }
}

// Se não logou:
echo "Email ou senha incorretos.";
exit;
?>
