<?php
require_once __DIR__ . '/../dao/GeneroDAO.php';

$dao = new GeneroDAO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$genero = $dao->buscarPorId($id);

if (!$genero) {
    echo '<p>Gênero não encontrado.</p>';
    echo '<a href="?entidade=genero&acao=listar">Voltar</a>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_genero = $_POST['nome_genero'] ?? '';

    $dao->atualizar($id, $nome_genero);

    header('Location: ?entidade=genero&acao=listar');
    exit;
}

?>

<h1>Editar Gênero</h1>

<form method="post">
    <label>Nome do Gênero:</label><br>
    <input type="text" name="nome_genero" value="<?php echo htmlspecialchars($genero['nome_genero']); ?>" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="?entidade=genero&acao=listar">Cancelar</a>
