<?php
// excluir_usuario.php

// Verifica se o ID do usuário foi enviado via parâmetro GET
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Aqui você deve incluir o arquivo que contém a classe de conexão
    require_once('CConexao.php');

    try {
        // Cria uma instância da classe de conexão
        $conexao = new CConexao();
        $conn = $conexao->getConnection();

        // Prepara a consulta SQL para excluir o usuário com o ID fornecido
        $sql = "DELETE FROM usuario WHERE idUsuario = :idUsuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario);
        
        // Executa a consulta para excluir o usuário
        $stmt->execute();

        // Verifica se a exclusão foi realizada com sucesso
        if ($stmt->rowCount() > 0) {
            // Redireciona de volta para a página de usuários após a exclusão
            header("Location: ../view/usuarios.php");
            exit();
        } else {
            echo "Falha ao excluir o usuário.";
            header("Location: ../view/usuarios.php");
        }
    } catch (PDOException $e) {
        echo "Erro na exclusão do usuário: " . $e->getMessage();
    }
} else {
    // Se o ID não foi fornecido, exibe uma mensagem de erro ou redireciona para outra página
    echo "ID do usuário não fornecido.";
    // Ou redirecione para a página de usuários ou outra página
    // header("Location: alguma_pagina.php");
    exit();
}
?>