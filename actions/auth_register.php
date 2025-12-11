<?php
include '../config/connection.php';

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); 
    $nivel = $_POST["nivel_acesso"];

    $sql = "INSERT INTO login (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $nivel);

    if ($stmt->execute()) {
    header("Location: login.php"); 
    exit();
        } else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>