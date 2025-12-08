<?php
session_start();

// Destruir todas as variáveis de sessão.
$_SESSION = array();
session_destroy();

header("Location: login.php?status=loggedout");
exit;