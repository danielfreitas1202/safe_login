<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$nivel = $_SESSION['nivel'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h1>Painel do Usuário</h1>

        <p>
            Bem-vindo,
            <strong>
                <?php echo htmlspecialchars($_SESSION['nome']); ?>
            </strong>
        </p>
    </div>

    <div class="dashboard-grid">

        <?php if ($nivel == 'nivel1'): ?>

            <a href="pasta_p.php" class="dashboard-card">
                <div class="card-icon">🎨</div>
                <h3>Clientes Personalizados</h3>
                <p>Conteúdo liberado para nível 1</p>
            </a>

        <?php endif; ?>


        <?php if ($nivel == 'nivel2'): ?>

            <a href="pasta_pe.php" class="dashboard-card">
                <div class="card-icon">📦</div>
                <h3>Clientes Pronta Entrega</h3>
                <p>Conteúdo liberado para nível 2</p>
            </a>

        <?php endif; ?>


        <?php if ($nivel == 'nivel3'): ?>

            <a href="pasta_p.php" class="dashboard-card">
                <div class="card-icon">🎨</div>
                <h3>Clientes Personalizados</h3>
                <p>Acesso completo</p>
            </a>

            <a href="pasta_pe.php" class="dashboard-card">
                <div class="card-icon">📦</div>
                <h3>Clientes Pronta Entrega</h3>
                <p>Acesso completo</p>
            </a>

        <?php endif; ?>

        <a href="logout.php" class="dashboard-card logout-card">
            <div class="card-icon">🚪</div>
            <h3>Sair</h3>
            <p>Encerrar sessão</p>
        </a>

    </div>

</div>

</body>
</html>