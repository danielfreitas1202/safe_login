<?php
session_start();
$erros = $_SESSION['erros'] ?? [];
unset($_SESSION['erros']);
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
                <option value="user">User</option>
                <option value="admin">Admin</option>
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