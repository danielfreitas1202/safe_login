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

    // verifica se há campos vazios
if (empty($email) || empty($senha)) {
    echo "Preencha todos os campos";
    exit; // interrompe o script
}
    // valida formato do email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email inválido";
    exit;
}

// Busca usuário (CORRIGIDO)
$sql = "SELECT id_usuario, nivel, senha_hash, ativo 
        FROM usuario 
        WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

//não tem nenhuma validação de entrada


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