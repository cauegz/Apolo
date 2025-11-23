<?php
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';

$dao = new AvaliacaoDAO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$avaliacao = $dao->buscarPorId($id);

if (!$avaliacao) {
    echo '<p>Avaliação não encontrada.</p>';
    echo '<a href="?entidade=avaliacao&acao=listar">Voltar</a>';
    exit;
}

$alunos = $dao->listarAlunos();
$filmes = $dao->listarFilmes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aluno = $_POST['id_aluno'] ?? '';
    $id_filme = $_POST['id_filme'] ?? '';
    $nota = $_POST['nota'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    $data_avaliacao = $_POST['data_avaliacao'] ?? '';

    $dao->atualizar($id, $id_aluno, $id_filme, $nota, $comentario, $data_avaliacao);

    header('Location: ?entidade=avaliacao&acao=listar');
    exit;
}

?>

<h1>Editar Avaliação</h1>

<form method="post">

    <label>Aluno:</label><br>
    <select name="id_aluno" required>
        <option value="">-- selecione --</option>

        <?php foreach ($alunos as $a): ?>
            <option value="<?= htmlspecialchars($a['id_aluno']) ?>"
                <?= $a['id_aluno'] == $avaliacao['id_aluno'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Filme:</label><br>
    <select name="id_filme" required>
        <option value="">-- selecione --</option>

        <?php foreach ($filmes as $f): ?>
            <option value="<?= htmlspecialchars($f['id_filme']) ?>"
                <?= $f['id_filme'] == $avaliacao['id_filme'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($f['nome_filme']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Nota (1 a 5):</label><br>
    <input type="number" name="nota" min="1" max="5"
           value="<?= htmlspecialchars($avaliacao['nota']) ?>" required>
    <br><br>

    <label>Comentário:</label><br>
    <textarea name="comentario" rows="4" cols="40"><?= htmlspecialchars($avaliacao['comentario']) ?></textarea>
    <br><br>

    <label>Data da Avaliação:</label><br>
    <input type="date" name="data_avaliacao"
           value="<?= htmlspecialchars($avaliacao['data_avaliacao']) ?>" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="?entidade=avaliacao&acao=listar">Cancelar</a>
