<?php
session_start();
//para evitar alguem tentar acessar a pagina manualmente
if ($_SESSION['nivel'] != 'admin' && $_SESSION['nivel'] != 'subadmin') {

    die("Acesso negado");
}

if (!isset($_SESSION['id_usuario']) || $_SESSION['nivel'] != 'admin' && $_SESSION['nivel'] !='subadmin') {
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

<p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>

<a href="cadastro.php" class="btn-cadastro">Cadastrar</a>

<a href="pasta_pe.php">Clientes Pronta Entrega</a>

<a href="pe.php">Clientes Personalizados</a>

<a href="logout.php">Sair</a>

</body>
</html> 