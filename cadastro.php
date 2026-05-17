<?php
session_start();
//para verificar erros
$erros = $_SESSION['erros'] ?? [];
unset($_SESSION['erros']);

if ($_SESSION['nivel'] != 'admin' && $_SESSION['nivel'] != 'subadmin') {

    die("Acesso negado");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Cadastrar Usuário</h2>
    <a href="painel_admin.php">Voltar</a>

    <form method="POST" action="salvar_usuario.php">

        <div class="input-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            <?php if (isset($erros['nome'])): ?>
                <small style="color:red;"><?= $erros['nome'] ?></small>
            <?php endif; ?>
        </div>

        <div class="input-group">
            <label>Email:</label>
            <input type="email" name="email" required>
            <?php if (isset($erros['email'])): ?>
                <small style="color:red;"><?= $erros['email'] ?></small>
            <?php endif; ?>
        </div>

        <div class="input-group">
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <?php if (isset($erros['senha'])): ?>
                <small style="color:red;"><?= $erros['senha'] ?></small>
            <?php endif; ?>
        </div>

        <div class="input-group">
            <label>Nível:</label>
            <select name="nivel">
                <option value="nivel1">Nível 1</option>
                <option value="nivel2">Nível 2</option>
                <option value="nivel3">Nível 3</option>
                <?php if ($_SESSION['nivel'] == 'admin') { ?>

                    <option value="subadmin">Sub Admin</option>
                    <option value="admin">Admin</option>

                <?php } ?>
            </select>
        </div>

        <div class="input-group">
            <label>Ativo:</label>
            <select name="ativo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <button type="submit">Salvar</button>
    </form>

    <div style="margin-top: 10px;">
        <a href="listar_usuarios.php">Ver usuários</a>
    </div>

    <div class="footer"> 
        © 2026 - Seu Sistema
    </div>
</div>

</body>
</html>