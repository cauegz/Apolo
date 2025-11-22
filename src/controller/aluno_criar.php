<?php
require_once __DIR__ . '/../dao/AlunoDAO.php';

$dao = new AlunoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim(isset($_POST['nome']) ? $_POST['nome'] : '');
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');

    $erros = array();

    if ($nome === '') {
        $erros[] = 'Nome é obrigatório';
    }
    if ($email === '') {
        $erros[] = 'Email é obrigatório';
    }

    if (empty($erros)) {
        $dao->criar($nome, $email);
        header('Location: ?entidade=aluno&acao=listar');
        exit;
    }
}

echo '<h1>Novo Aluno</h1>';

if (!empty($erros)) {
    echo '<div style="color:red;">'.implode('<br>', array_map('htmlspecialchars', $erros)).'</div>';
}

echo '<form method="post">
    <label>Nome: <input type="text" name="nome"></label><br>
    <label>Email: <input type="text" name="email"></label><br>
    <button type="submit">Salvar</button>
    <a href="?entidade=aluno&acao=listar">Cancelar</a>
</form>';
?>