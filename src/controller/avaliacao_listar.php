<?php
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';

$dao = new AvaliacaoDAO();
$avaliacoes = $dao->listarTodasAvaliacoes();
$alunos = $dao->listarAlunos();
$filmes = $dao->listarFilmes();

// Transformar listagens em mapas para acesso rápido
$mapAlunos = [];
foreach ($alunos as $a) {
    $mapAlunos[$a['id_aluno']] = $a['nome'];
}

$mapFilmes = [];
foreach ($filmes as $f) {
    $mapFilmes[$f['id_filme']] = $f['nome_filme'];
}

echo '<h1>Avaliações</h1>';
echo '<a href="?entidade=avaliacao&acao=criar">Nova Avaliação</a><br><br>';

echo '<table border="1" cellpadding="5">';
echo '<tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Filme</th>
        <th>Nota</th>
        <th>Comentário</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>';

foreach ($avaliacoes as $a) {
    $nomeAluno = isset($mapAlunos[$a['id_aluno']]) 
                    ? $mapAlunos[$a['id_aluno']] 
                    : 'Aluno não encontrado';

    $nomeFilme = isset($mapFilmes[$a['id_filme']]) 
                    ? $mapFilmes[$a['id_filme']] 
                    : 'Filme não encontrado';

    echo '<tr>';
    echo '<td>'.htmlspecialchars($a['id_avaliacao']).'</td>';
    echo '<td>'.htmlspecialchars($nomeAluno).'</td>';
    echo '<td>'.htmlspecialchars($nomeFilme).'</td>';
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
