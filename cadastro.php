<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
</head>
<body>

<h2>Cadastrar Usuário</h2>

<form method="POST" action="salvar_usuario.php">
    Nome: <input type="text" name="nome" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Senha: <input type="password" name="senha" required><br><br>

    Nível:
    <select name="nivel">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    Ativo:
    <select name="ativo">
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="listar_usuarios.php">Ver usuários</a>

</body>
</html>