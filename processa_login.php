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

    // Verificação para senhas do MYSQL com MD5
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

// Se não logou: renderiza uma página com header/footer (mostra botão Voltar)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Login - Falha</title>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="alert error">Email ou senha incorretos.</div>
        <a href="login.php" class="botao-voltar">Voltar ao Login</a>
    </div>
</body>
</html>
<?php
exit;
?>
