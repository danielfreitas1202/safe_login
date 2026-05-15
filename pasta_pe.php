<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}

//para evitar alguem tentar acessar a pagina manualmente
if ($_SESSION['nivel'] != 'nivel2' &&
    $_SESSION['nivel'] != 'nivel3') {

    die("Acesso negado");
}

$sql = "SELECT * FROM usuario ORDER BY id_usuario DESC";
$result = mysqli_query($conn, $sql);

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- ligação com o CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>

    <div class="box_search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">id_usuario</th>
        <th scope="col">nome</th>
        <th scope="col">email</th>
        <th scope="col">data</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo $row['id_usuario']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['data_criacao']; ?></td>
                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="4" class="text-center">
                        Nenhum usuário encontrado.
                    </td>
                </tr>

            <?php } ?>
    </tbody>
    </table>

</body>
