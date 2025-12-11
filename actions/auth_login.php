<?php
session_start();
include '../config/connection.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM login WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifica a senha usando password_verify para senhas hash
    // Ou verifica com MD5 ou texto plano para senhas antigas (se ainda houver)
    if (password_verify($senha, $user["senha"]) || (md5($senha) === $user["senha"]) || ($senha === $user["senha"])) {
        // Se a senha for MD5 ou texto plano e o PHP estiver usando password_hash,
        // é uma boa prática re-hashear a senha e atualizar no banco de dados
        if (($senha === $user["senha"] || md5($senha) === $user["senha"]) && password_needs_rehash($user["senha"], PASSWORD_DEFAULT)) {
            $new_hash = password_hash($senha, PASSWORD_DEFAULT);
            $update_sql = "UPDATE login SET senha = ? WHERE id_usuario = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_hash, $user["id_usuario"]);
            $update_stmt->execute();
        }
        $_SESSION["loggedin"] = true;
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["nivel"] = $user["nivel_acesso"];
        header("Location: ../pages/main/hub.php?status=loggedin");
        exit();
    }
}

// Se não logou:
echo "Email ou senha incorretos.";
exit;
?>
