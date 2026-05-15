<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$nivel = $_SESSION['nivel'];
?>

<h1>Painel do Usuário</h1>

<?php if ($nivel == 'nivel1'): ?>

    <h2>Pasta P</h2>
    <p>Conteúdo liberado para nível 1</p>
    <a href="pe.php">Produtos Pronta Entrega</a>
    <a href="logout.php">Sair</a>

<?php endif; ?>

<?php if ($nivel == 'nivel2'): ?>

    <h2>Pasta PE</h2>
    <p>Conteúdo liberado para nível 2</p>
    <a href="pasta_pe.php">Produtos Pronta Entrega</a>
    <a href="logout.php">Sair</a>

<?php endif; ?>

<?php if ($nivel == 'nivel3'): ?>

    <h2>Pasta P</h2>
    <p>Conteúdo nível 1</p>

    <h2>Pasta PE</h2>
    <p>Conteúdo nível 2</p>

    <a href="logout.php">Sair</a>

<?php endif; ?>