<?php
session_start();
include("conexao.php");

if (isset($_SESSION['id_usuario'])) {
    $id = $_SESSION['id_usuario'];

    mysqli_query($conn, "INSERT INTO log (id_usuario, acao, data_hora) 
                         VALUES ($id, 'logout', NOW())");
}

session_destroy();

header("Location: index.html");
exit;
?>