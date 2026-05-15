<?php
session_start();

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