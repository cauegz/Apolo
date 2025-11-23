<?php
require_once __DIR__ . '/../dao/GeneroDAO.php';

$dao = new GeneroDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_genero = $_POST['id_genero'] ?? '';
    $nome_genero = $_POST['nome_genero'] ?? '';

    $dao->criar($id_genero, $nome_genero);

    header('Location: ?entidade=genero&acao=listar');
    exit;
}

?>

<h1>Novo Gênero</h1>

<form method="post">

    <label>Nome do Gênero:</label><br>
    <input type="text" name="nome_genero" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="?entidade=genero&acao=listar">Cancelar</a>

