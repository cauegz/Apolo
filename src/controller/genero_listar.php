<?php
require_once __DIR__ . '/../dao/GeneroDAO.php';

$dao = new GeneroDAO();
$generos = $dao->listarTodos();

echo '<h1>Gêneros</h1>';
echo '<a href="?entidade=genero&acao=criar">Novo Gênero</a><br><br>';

echo '<table border="1" cellpadding="5">';
echo '<tr>
        <th>ID</th>
        <th>Nome do Gênero</th>
        <th>Ações</th>
      </tr>';

foreach ($generos as $g) {
    echo '<tr>';
    echo '<td>'.htmlspecialchars($g['id_genero']).'</td>';
    echo '<td>'.htmlspecialchars($g['nome_genero']).'</td>';
    echo '<td>
            <a href="?entidade=genero&acao=editar&id=' . $g['id_genero'] . '">Editar</a> |
            <a href="?entidade=genero&acao=excluir&id=' . $g['id_genero'] . '" 
               onclick="return confirm(\'Excluir gênero?\');">Excluir</a>
          </td>';
    echo '</tr>';
}

echo '</table>';
echo '<br> <a href="index.php">Voltar</a>';