<?php
include("conexao.php");

// Verifica se veio ID
if (!isset($_GET['id'])) {
    echo "ID não informado.";
    exit;
}

$id = $_GET['id'];

// Faz "exclusão lógica"
$sql = "UPDATE usuario SET ativo = 0 WHERE id_usuario = $id";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Usuário desativado com sucesso!<br>";
    echo "<a href='listar_usuarios.php'>Voltar</a>";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>