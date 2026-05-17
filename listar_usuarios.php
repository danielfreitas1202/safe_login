<?php
session_start();
include("conexao.php");

$sql = "SELECT * FROM usuario ORDER BY id_usuario DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-container">

    <div class="top-bar">
        <h2>Usuários cadastrados</h2>

        <div class="actions">
            <a class="btn btn-primary" href="cadastro.php">Novo usuário</a>
            <a class="btn btn-secondary" href="painel_admin.php">Voltar</a>
        </div>
    </div>

    <div class="table-container">

        <table class="user-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

            <?php if ($result && mysqli_num_rows($result) > 0) { ?>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo $row['id_usuario']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <span class="badge nivel">
                            <?php echo $row['nivel']; ?>
                        </span>
                    </td>

                    <td>
                        <?php if($row['ativo'] == 1) { ?>
                            <span class="badge ativo">Ativo</span>
                        <?php } else { ?>
                            <span class="badge inativo">Inativo</span>
                        <?php } ?>
                    </td>

                    <td class="table-actions">

                        <a class="table-btn edit"
                           href="editar_usuario.php?id=<?php echo $row['id_usuario']; ?>">
                           Editar
                        </a>

                        <?php if ($_SESSION['nivel'] == 'admin') { ?>

                            <a class="table-btn delete"
                               href="excluir_usuario.php?id=<?php echo $row['id_usuario']; ?>">
                               Excluir
                            </a>

                        <?php } ?>

                    </td>
                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6" class="empty-table">
                        Nenhum usuário encontrado.
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>