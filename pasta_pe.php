<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}

//para evitar alguem tentar acessar a pagina manualmente
if ($_SESSION['nivel'] != 'nivel2' && $_SESSION['nivel'] != 'nivel3' && $_SESSION['nivel'] != 'admin' && $_SESSION['nivel'] != 'subadmin') {

    die("Acesso negado");
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes PE</title>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="page-container">

    <div class="top-bar">

        <div>
            <h2 class="page-title">Clientes cadastrados</h2>
            <p class="page-subtitle">
                Lista de clientes Pronto Entrega
            </p>
        </div>
        <?php if ($_SESSION['nivel'] == 'admin' || $_SESSION['nivel'] == 'subadmin') { ?>
            <a href="painel_admin.php" class="btn btn-secondary-custom">
                ← Voltar
            </a>
        <?php } ?>
        <?php if ($_SESSION['nivel'] == 'nivel2' || $_SESSION['nivel'] == 'nivel3') { ?>
            <a href="painel_user.php" class="btn btn-secondary-custom">
                ← Voltar
            </a>
        <?php } ?>

    </div>

    <div class="table-card">

        <table class="table custom-table align-middle">

            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Adriana</td>
                    <td>45.698.324/0001-44</td>
                    <td>adriana@gmail.com</td>
                </tr>
                <tr>
                    <td>Bernardo</td>
                    <td>12.834.765/0001-09</td>
                    <td>bernardo@gmail.com</td>
                </tr>
                <tr>
                    <td>Valéria</td>      
                    <td>87.213.904/0001-57</td>
                    <td>valeria@gmail.com</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>