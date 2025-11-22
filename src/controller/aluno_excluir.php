<?php
// src/controller/aluno_excluir.php

require_once __DIR__ . '/../dao/AlunoDAO.php';

$dao = new AlunoDAO();

// Obtém o ID da URL de forma segura, convertendo para inteiro
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Se o ID for válido, executa a exclusão no banco
if ($id > 0) { 
    $dao->excluir($id); 
}

// Redireciona de volta para a listagem
header('Location: ?entidade=aluno&acao=listar');
exit;
?>