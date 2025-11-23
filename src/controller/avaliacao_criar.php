<?php
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';

$dao = new AvaliacaoDAO();
$alunos = $dao->listarAlunos();
$filmes = $dao->listarFilmes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aluno = $_POST['id_aluno'] ?? '';
    $id_filme = $_POST['id_filme'] ?? '';
    $nota = $_POST['nota'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    $data_avaliacao = $_POST['data_avaliacao'] ?? '';

    $dao->criarAvaliacao(null, $id_aluno, $id_filme, $nota, $comentario, $data_avaliacao);

    header('Location: ?entidade=avaliacao&acao=listar');
    exit;
}
?>

<h1>Nova Avaliação</h1>

<form method="post">

    <label>Aluno:</label><br>
    <select name="id_aluno" required>
        <option value="">-- selecione --</option>

        <?php if (empty($alunos)) : ?>
            <option disabled>Nenhum aluno cadastrado</option>
        <?php else: ?>
            <?php foreach ($alunos as $a): ?>
                <option value="<?= htmlspecialchars($a['id_aluno']) ?>">
                    <?= htmlspecialchars($a['nome']) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <br><br>

    <label>Filme:</label><br>
    <select name="id_filme" required>
        <option value="">-- selecione --</option>

        <?php if (empty($filmes)) : ?>
            <option disabled>Nenhum filme cadastrado</option>
        <?php else: ?>
            <?php foreach ($filmes as $f): ?>
                <option value="<?= htmlspecialchars($f['id_filme']) ?>">
                    <?= htmlspecialchars($f['nome_filme']) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <br><br>

    <label>Nota (1 a 5):</label><br>
    <input type="number" name="nota" min="1" max="5" required>
    <br><br>

    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" cols="40"></textarea>
    <br><br>

    <label>Data da Avaliação:</label><br>
    <input type="date" name="data_avaliacao" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="?entidade=avaliacao&acao=listar">Cancelar</a>
