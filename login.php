<?php
session_start();
// recebe dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['tentativas'])) {
        $_SESSION['tentativas'] = 0;
    }

    // remove espaços antes/depois
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // verifica se há campos vazios
    if (empty($email) || empty($senha)) {
        echo "Preencha todos os campos";
        exit; // interrompe o script
    }

    $usuarios = [
        "ana@email.com" => ["senha" => "123", "nivel" => "RH"],
        "pedro@email.com" => ["senha" => "456", "nivel" => "Admin"],
        "daniel@email.com" => ["senha" => "789", "nivel" => "suporte"]
    ];

    // verifica usuário e senha
    if (isset($usuarios[$email]) && $usuarios[$email]['senha'] == $senha) {
        $_SESSION['tentativas'] = 0;

        // armazena dados na sessão (login persistente)
        $_SESSION['usuario'] = $email;
        $_SESSION['nivel'] = $usuarios[$email]['nivel'];

        // redireciona para área logada
        header("Location: painel.php");
        exit;

    } else {
        // usuário não encontrado
        $_SESSION['tentativas']++;
        if ($_SESSION['tentativas'] >= 3) {
            header("Location: block.php");
            $_SESSION['tentativas'] = 0;
        }
        exit;
    }


}
?>