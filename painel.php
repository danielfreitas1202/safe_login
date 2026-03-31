<?php
// inicia sessão
session_start();

// verifica se usuário está logado
if (!isset($_SESSION['usuario'])) {

    // se não estiver, volta para login
    header("Location: login.html");
    exit;
}

// exibe dados do usuário
// htmlspecialchars() evita  XSS ao exibir dados do usuário (injeção de código JavaScript no campo de login)
echo "Bem-vindo " . htmlspecialchars($_SESSION['usuario']);
echo "<br>Nível: " . htmlspecialchars($_SESSION['nivel']);

if (($_SESSION['nivel'] == "Admin") || ($_SESSION['nivel'] == "suporte")) {
    echo "<br>Área administrativa";
    echo '<br><a href="logout.php">Sair</a>';
}

// controle de acesso por nível
if (($_SESSION['nivel'] != "Admin") && ($_SESSION['nivel'] != "suporte")) {
    echo "<br>Acesso restrito!";
    echo '<br><a href="logout.php">Sair</a>';
    exit;
}


?>