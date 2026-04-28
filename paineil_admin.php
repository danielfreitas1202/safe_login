<?php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['nivel'] != 'admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel Admin</title>
</head>
<body>

<h2>Painel do Administrador</h2>

<p>Bem-vindo, administrador!</p>

<a href="logout.php">Sair</a>

</body>
</html>