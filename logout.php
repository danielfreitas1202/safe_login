<?php
// inicia a sessão
session_start();

// destrói todos os dados da sessão
session_destroy();

// mensagem simples
echo "Você saiu do sistema.";

// link para voltar
echo '<br><a href="index.html">Voltar para login</a>';
?>