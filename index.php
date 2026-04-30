<?php
session_start();
$erros = $_SESSION['erros'] ?? [];
unset($_SESSION['erros']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- ligação com o CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <form action="login.php" method="POST">
        
    <div class="input-group">
        <label>Email:</label>
        <input type="email" name="email" required>

        <?php if (isset($erros['email'])): ?>
            <small style="color:red;"><?= $erros['email'] ?></small>
        <?php endif; ?>
    </div>

    <div class="input-group">
        <label>Senha?</label>
        <input type="password" name="senha" required>

        <?php if (isset($erros['senha'])): ?>
            <small style="color:red;"><?= $erros['senha'] ?></small>
        <?php endif; ?>
    </div>

        <button type="submit">Entrar</button>
    </form>
    <a href="cadastro.php" class="btn-cadastro">Cadastrar</a>

    <div class="footer"> 
        © 2026 - Seu Sistema
    </div>
</div>

</body>
</html>