<?php
session_start();
include("conexao.php");

// ==========================
// 1. CARREGAR DADOS (GET)
// ==========================
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Usuário não encontrado.";
        exit;
    }
}

// ==========================
// 2. ATUALIZAR (POST)
// ==========================
if (isset($_POST['id_usuario'])) {

    $id = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $nome = htmlspecialchars($nome);
    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    $nivel = $_POST['nivel'];
    $ativo = $_POST['ativo'];

    $sql = "UPDATE usuario SET 
            nome = '$nome',
            email = '$email',
            nivel = '$nivel',
            ativo = $ativo
            WHERE id_usuario = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Usuário atualizado com sucesso!<br>";
        echo "<a href='listar_usuarios.php'>Voltar</a>";
        exit;
    } else {
        echo "Erro: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
</head>
<body>

<h2>Editar Usuário</h2>

<?php if (isset($user)) { ?>

<form method="POST">

    <input type="hidden" name="id_usuario" value="<?php echo $user['id_usuario']; ?>">

    Nome: <input type="text" name="nome" value="<?php echo $user['nome']; ?>" required><br><br>
    
    Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

    Nível:
    <select name="nivel">
        <?php if ($_SESSION['nivel'] == 'admin') { ?>
            <option value="admin" <?php if ($user['nivel'] == 'admin') echo "selected"; ?>>Admin</option>
            <option value="sub admin" <?php if ($user['nivel'] == 'sub admin') echo "selected"; ?>>Sub Admin</option>
        <?php } ?>
        <option value="nivel1" <?php if ($user['nivel'] == 'nivel1') echo "selected"; ?>>nivel1</option>
        <option value="nivel2" <?php if ($user['nivel'] == 'nivel2') echo "selected"; ?>>nivel2</option>
        <option value="nivel3" <?php if ($user['nivel'] == 'nivel3') echo "selected"; ?>>nivel3</option>
    </select>
    <br><br>

    Ativo:
    <select name="ativo">
        <option value="1" <?php if ($user['ativo'] == 1) echo "selected"; ?>>Sim</option>
        <option value="0" <?php if ($user['ativo'] == 0) echo "selected"; ?>>Não</option>
    </select>
    <br><br>

    <button type="submit">Salvar</button>

</form>

<?php } ?>

</body>
</html>