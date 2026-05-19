<?php
session_start();
include("conexao.php"); 

//registrar as tentativas de login
function registrarTentativa($conn, $id_usuario, $email, $sucesso, $ip) {

    $stmt = mysqli_prepare($conn,
        "INSERT INTO tentativa_login 
        (id_usuario, email_informado, data_hora, sucesso, ip)
        VALUES (?, ?, NOW(), ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isis",
        $id_usuario,
        $email,
        $sucesso,
        $ip
    );

    mysqli_stmt_execute($stmt);
}

// configurações do bloqueio
$limite_tentativas = 3;
$tempo_bloqueio = 600; // 10 minutos em segundos

// cria variáveis se não existirem
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

if (!isset($_SESSION['bloqueado_ate'])) {
    $_SESSION['bloqueado_ate'] = 0;
}

// verifica bloqueio
if (time() < $_SESSION['bloqueado_ate']) {

    $tempo_restante = $_SESSION['bloqueado_ate'] - time();
    $minutos = ceil($tempo_restante / 60);

    $_SESSION['erros']['login'] =
        "Muitas tentativas. Tente novamente em $minutos minuto(s).";

    header("Location: index.php");
    exit;
}

// Evita acesso direto
if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    header("Location: index.php");
    exit;
}

$email = trim($_POST['email']);
$senha = trim($_POST['senha']); 
$ip = $_SERVER['REMOTE_ADDR'];

$erros = [];

//evita que o usuario não preencha algum campo
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

// Busca usuário
$sql = "SELECT id_usuario, nome, nivel, senha_hash, ativo 
        FROM usuario 
        WHERE email = ?";

mysqli_stmt_bind_param($stmt, "s", $email);

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    $user = mysqli_fetch_assoc($result);
    
    if (password_verify($senha, $user['senha_hash']) && $user['ativo'] == 1) {

        registrarTentativa(
            $conn,
            $user['id_usuario'],
            $email,
            1,
            $ip
        );
        
        $_SESSION['tentativas'] = 0;
        $_SESSION['bloqueado_ate'] = 0;
        
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nivel'] = $user['nivel'];
        $_SESSION['nome'] = $user['nome'];
        
        if ($user['nivel'] == 'admin' || $user['nivel'] == 'subadmin') {
            header("Location: painel_admin.php");
        } else {
            header("Location: painel_user.php");
        }
        
        exit;
        
    } else {
        
        registrarTentativa(
            $conn,
            $user['id_usuario'],
            $email,
            0,
            $ip
        );
        
        $_SESSION['tentativas']++;

        // atingiu limite?
        if ($_SESSION['tentativas'] >= $limite_tentativas) {

            $_SESSION['bloqueado_ate'] = time() + $tempo_bloqueio;

            $_SESSION['erros']['login'] = "Você excedeu o limite de tentativas. Aguarde 10 minutos.";

        } else {

        $restantes = $limite_tentativas - $_SESSION['tentativas'];

        $_SESSION['erros']['login'] =
        "Login inválido. Restam $restantes tentativa(s).";
    }

    header("Location: index.php");
    exit;
    }
    
} else {

    registrarTentativa(
        $conn,
        null,
        $email,
        0,
        $ip
    );

    $_SESSION['tentativas']++;

    if ($_SESSION['tentativas'] >= $limite_tentativas) {

        $_SESSION['bloqueado_ate'] = time() + $tempo_bloqueio;

        $_SESSION['erros']['login'] = "Você excedeu o limite de tentativas. Aguarde 10 minutos.";

    } else {

        $restantes = $limite_tentativas - $_SESSION['tentativas'];

        $_SESSION['erros']['login'] =
            "Login inválido. Restam $restantes tentativa(s).";
    }

    header("Location: index.php");
    exit;
}
?>