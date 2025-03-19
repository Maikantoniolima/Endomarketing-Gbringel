<?php
// Início da sessão
session_start();

// Função para excluir a foto enviada
function excluirFotoEnviada() {
    if (isset($_SESSION['foto'])) {
        $caminho_arquivo = $_SESSION['foto'];
        if (file_exists($caminho_arquivo)) {
            unlink($caminho_arquivo);
        }
        unset($_SESSION['foto']);
    }
}

// Exclui a foto enviada
excluirFotoEnviada();
?>