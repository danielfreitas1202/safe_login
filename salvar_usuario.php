<?php
include("conexao.php");

// Evita acesso direto
if (!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha'])) {
    echo "Acesso inválido.";
    exit;
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$nivel = $_POST['nivel'];
$ativo = $_POST['ativo'];

$sql = "INSERT INTO usuario (nome, email, senha_hash, nivel, ativo, data_criacao) 
        VALUES ('$nome', '$email', '$senha', '$nivel', '$ativo', NOW())";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Usuário cadastrado com sucesso!<br>";
    echo "<a href='listar_usuarios.php'>Ver usuários</a>";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>