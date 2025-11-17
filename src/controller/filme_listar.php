<?php 
require_once __DIR__ . '/../dao/FilmeDAO.php'; 
$dao = new FilmeDAO(); 
$filmes = $dao->listarTodosFilmes(); 
echo '<h1>Filmes</h1>'; 
echo '<a href="?entidade=filme&acao=criar">Novo Filme</a>'; 
echo '<table border="1" cellpadding="5">'; 
echo 
'<tr><th>ID</th><th>Nome</th><th>Diretor</th><th>Descrição</th><th>Gênero</th><th>Ações</th></tr>'; 
foreach ($filmes as $f) { 
    echo '<tr>'; 
    echo '<td>'.htmlspecialchars($f['id_filme']).'</td>'; 
    echo '<td>'.htmlspecialchars($f['nome_filme']).'</td>'; 
    echo '<td>'.htmlspecialchars($f['diretor']).'</td>'; 
    echo '<td>'.htmlspecialchars($f['descricao']).'</td>'; 
    echo '<td>'.htmlspecialchars($f['nome_genero']).'</td>';
    echo '<td> 
        <a href="?entidade=filme&acao=editar&id_filme=' . htmlspecialchars($f['id_filme']) . '">Editar</a> | 
        <a href="?entidade=filme&acao=excluir&id_filme='.$f['id_filme'].'" 
        onclick="return confirm(\'Excluir?\');">Excluir</a> 
    </td>'; 
    echo '</tr>'; 
} 
echo '</table>'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filmeslista</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
</body>
</html>
