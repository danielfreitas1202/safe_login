<?php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['nivel'] != 'user') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html> 
<head>
    <title>Painel Usuário</title>
</head>
<body>

<h2>Painel do Usuário</h2>

<p>Bem-vindo, usuário!</p>

<a href="logout.php">Sair</a>

</body>
</html>