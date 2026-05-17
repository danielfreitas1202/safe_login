<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}

//para evitar alguem tentar acessar a pagina manualmente
if ($_SESSION['nivel'] != 'nivel1' &&
    $_SESSION['nivel'] != 'nivel3') {

    die("Acesso negado");
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>clientes_pp</title>

    <!-- ligação com o CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">nome</th>
        <th scope="col">CNPJ</th>
        <th scope="col">email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Alex</td>
            <td>33.456.129/0001-81</td>
            <td>alex@gmail.com</td>
        </tr>
        <tr>
            <td>Vitória</td>      
            <td>29.543.876/0001-11</td>
            <td>vitória@gmail.com</td>
        </tr>
        <tr>
            <td>Vívian</td>
            <td>61.094.332/0001-23</td>
            <td>vivian@gmail.com</td>
        </tr>
    </tbody>
    </table>

</body>
