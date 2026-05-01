<?php
include("conexao.php");

// Evita acesso direto
if (!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha'])) {
    echo "Acesso inválido.";
    exit;
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$nivel = $_POST['nivel'];
$ativo = $_POST['ativo'];

$stmt = mysqli_prepare($conn, 
    "INSERT INTO usuario (nome, email, senha_hash, nivel, ativo, data_criacao) 
     VALUES (?, ?, ?, ?, ?, NOW())"
);

mysqli_stmt_bind_param($stmt, "ssssi", $nome, $email, $senha, $nivel, $ativo);

$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "Usuário cadastrado com sucesso!<br>"; 
    echo "<a href='listar_usuarios.php'>Ver usuários</a>";
} else {
    if (mysqli_errno($conn) == 1062) {
        echo "Email já cadastrado.";
    } else {
        echo "Erro: " . mysqli_error($conn);
    }
}
?>