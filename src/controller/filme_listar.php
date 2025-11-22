<?php 
// Note: Se este arquivo é carregado pelo index.php, o FilmeDAO já deve estar acessível 
// ou o caminho do require deve considerar que estamos na raiz.
// Mas vamos manter o __DIR__ para garantir que ele ache o arquivo.
require_once __DIR__ . '/../dao/FilmeDAO.php'; 

$dao = new FilmeDAO(); 
$filmes = $dao->listarTodosFilmes(); 
?>

<h1>Filmes</h1>

<a href="index.php?entidade=filme&acao=criar">Novo Filme</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Diretor</th>
        <th>Descrição</th>
        <th>Gênero</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($filmes as $f): ?>
        <tr>
            <td><?php echo htmlspecialchars($f['id_filme']); ?></td>
            <td><?php echo htmlspecialchars($f['nome_filme']); ?></td>
            <td><?php echo htmlspecialchars($f['diretor']); ?></td>
            <td><?php echo htmlspecialchars($f['descricao']); ?></td>
            <td><?php echo htmlspecialchars($f['nome_genero']); ?></td>
            <td>
                <a href="index.php?entidade=filme&acao=editar&id_filme=<?php echo $f['id_filme']; ?>">
                    Editar
                </a> 
                | 
                <a href="index.php?entidade=filme&acao=excluir&id_filme=<?php echo $f['id_filme']; ?>" 
                   onclick="return confirm('Excluir?');">
                   Excluir
                </a> 
            </td>
        </tr>
    <?php endforeach; ?>
</table>