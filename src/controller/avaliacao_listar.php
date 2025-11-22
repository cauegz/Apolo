<?php
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';

$dao = new AvaliacaoDAO();
$avaliacoes = $dao->listarTodasAvaliacoes();

echo '<h1>Avaliações</h1>';
echo '<a href="?entidade=avaliacao&acao=criar">Nova Avaliação</a><br><br>';

echo '<table border="1" cellpadding="5">';
echo '<tr>
        <th>ID</th>
        <th>ID Aluno</th>
        <th>ID Filme</th>
        <th>Nota</th>
        <th>Comentário</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>';

foreach ($avaliacoes as $a) {
    echo '<tr>';
    echo '<td>'.htmlspecialchars($a['id_avaliacao']).'</td>';
    echo '<td>'.htmlspecialchars($a['id_aluno']).'</td>';
    echo '<td>'.htmlspecialchars($a['id_filme']).'</td>';
    echo '<td>'.htmlspecialchars($a['nota']).'</td>';
    echo '<td>'.htmlspecialchars($a['comentario']).'</td>';
    echo '<td>'.htmlspecialchars($a['data_avaliacao']).'</td>';
    echo '<td>
            <a href="?entidade=avaliacao&acao=editar&id=' . $a['id_avaliacao'] . '">Editar</a> |
            <a href="?entidade=avaliacao&acao=excluir&id=' . $a['id_avaliacao'] . '" 
               onclick="return confirm(\'Excluir avaliação?\');">Excluir</a>
          </td>';
    echo '</tr>';
}

echo '</table>';
