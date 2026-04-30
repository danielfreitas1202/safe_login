<?php
session_start();
include("conexao.php"); 

// Evita acesso direto
if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    header("Location: index.html");
    exit;
}

$email = trim($_POST['email']);
$senha = trim(md5($_POST['senha'])); //Muda o tipo de criptografia
$ip = $_SERVER['REMOTE_ADDR'];

if (empty($email)) {
    $erros['email'] = "Preencha o email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros['email'] = "Email inválido";
}

if (empty($senha)) {
    $erros['senha'] = "Preencha a senha";
}

if (!empty($erros)) {
    $_SESSION['erros'] = $erros;
    header("Location: index.php");
    exit;
}

// Busca usuário (CORRIGIDO)
$sql = "SELECT id_usuario, nivel, senha_hash, ativo 
        FROM usuario 
        WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

//não tem limite de tentativas de login 

//não armazena dados de quem tenta fazer login

if (mysqli_num_rows($result) > 0) {
    
    $user = mysqli_fetch_assoc($result);
    
    if ($user['senha_hash'] == $senha && $user['ativo'] == 1) {
        
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nivel'] = $user['nivel'];
        
        if ($user['nivel'] == 'admin') {
            header("Location: painel_admin.php");
        } else {
            header("Location: painel_user.php");
        }
        
        exit;
        
    } else {
        echo "Login inválido ou usuário bloqueado.";
    }
    
} else {
    echo "Usuário não encontrado.";
}
?>