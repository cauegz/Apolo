<?php
// src/controller/aluno_listar.php

// Importa o DAO
require_once __DIR__ . '/../dao/AlunoDAO.php';

// Instancia o DAO e busca os dados
$dao = new AlunoDAO();
$alunos = $dao->listarTodos();

// Exibe o título e o link para criar novo
echo '<h1>Alunos</h1>';
echo '<a href="?entidade=aluno&acao=criar">Novo Aluno</a>';

// Inicia a tabela
echo '<table border="1" cellpadding="5">';
echo '<tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>';

// Itera sobre os registros encontrados
foreach ($alunos as $a) {
    echo '<tr>';
    // Exibe os dados protegendo contra XSS com htmlspecialchars
    echo '<td>'.htmlspecialchars($a['id_aluno']).'</td>';
    echo '<td>'.htmlspecialchars($a['nome']).'</td>';
    echo '<td>'.htmlspecialchars($a['email']).'</td>';
    
    // Links de ação (Editar e Excluir)
    echo '<td>
        <a href="?entidade=aluno&acao=editar&id='.$a['id_aluno'].'">Editar</a> |
        <a href="?entidade=aluno&acao=excluir&id='.$a['id_aluno'].'" 
           onclick="return confirm(\'Excluir?\');">Excluir</a>
    </td>';
    
    echo '</tr>';
}

echo '</table>';
?>
