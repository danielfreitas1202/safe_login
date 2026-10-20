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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h1>Painel do Administrador</h1>

        <p>
            Bem-vindo,
            <strong>
                <?php echo htmlspecialchars($_SESSION['nome']); ?>
            </strong>
        </p>
    </div>

    <div class="dashboard-grid">

        <a href="cadastro.php" class="dashboard-card">
            <div class="card-icon">👤</div>
            <h3>Cadastrar</h3>
            <p>Novo usuário no sistema</p>
        </a>

        <a href="pasta_pe.php" class="dashboard-card">
            <div class="card-icon">📦</div>
            <h3>Clientes PE</h3>
            <p>Clientes pronta entrega</p>
        </a>

        <a href="pasta_p.php" class="dashboard-card">
            <div class="card-icon">🎨</div>
            <h3>Clientes Personalizados</h3>
            <p>Área personalizada</p>
        </a>

        <a href="logout.php" class="dashboard-card logout-card">
            <div class="card-icon">🚪</div>
            <h3>Sair</h3>
            <p>Encerrar sessão</p>
        </a>

    </div>

</div>

</body>
</html>