<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'sistema_gurus';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>