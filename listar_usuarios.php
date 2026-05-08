<?php
include("conexao.php");

$sql = "SELECT * FROM usuario ORDER BY id_usuario DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
</head>
<body>

<h2>Usuários cadastrados</h2>

<a href="cadastro.php">Novo usuário</a><br><br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Nível</th>
    <th>Ativo</th>
    <th>Ações</th>
</tr>

<?php if ($result && mysqli_num_rows($result) > 0) { ?>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

    <tr>
        <td><?php echo $row['id_usuario']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['nivel']; ?></td>
        <td><?php echo $row['ativo']; ?></td>
        <td>
            <a href="editar_usuario.php?id=<?php echo $row['id_usuario']; ?>">Editar</a> |
            <a href="excluir_usuario.php?id=<?php echo $row['id_usuario']; ?>">Excluir</a>
        </td>
    </tr>

    <?php } ?>

<?php } else { ?>

<tr>
    <td colspan="6">Nenhum usuário encontrado.</td>
</tr>

<?php } ?>

</table>

</body>
</html>