<?php
require_once __DIR__ . '/../dao/FilmeDAO.php';
$dao = new FilmeDAO();
$id = isset($_GET['id_filme']) ? (int)$_GET['id_filme'] : 0;
$filme = $dao->buscarPorId($id);

if (!$filme) {
    echo 'Filme não encontrado';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome_filme = trim($_POST['nome_filme'] ?? '');
    $diretor = trim($_POST['diretor'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $ano_lancamento = trim($_POST['ano_lancamento'] ?? '');
    $id_genero = trim($_POST['id_genero'] ?? '');

    // Valida os dados
    $erros = [];
    if ($nome_filme === '') $erros[] = 'Nome do filme é obrigatório';
    if ($diretor === '') $erros[] = 'Diretor é obrigatório';
    if ($descricao === '') $erros[] = 'Descrição é obrigatória';
    if ($ano_lancamento === '' || !ctype_digit($ano_lancamento)) $erros[] = 'Ano de lançamento deve ser numérico';
    if ($id_genero === '' || !ctype_digit($id_genero)) $erros[] = 'Gênero deve ser numérico';

    // Se não houver erros, atualiza o filme no banco de dados
    if (empty($erros)) {
        $dao->atualizar($id, $nome_filme, $diretor, $descricao, (int)$ano_lancamento, (int)$id_genero);
        header('Location: ?entidade=filme&acao=listar');
        exit;
    }
} else {
    $_POST = $filme;
}

echo '<h1>Editar Filme</h1>';
if (!empty($erros)) {
    echo '<div style="color:red;">' . implode('<br>', array_map('htmlspecialchars', $erros)) . '</div>';
}
echo '<form method="post">
    <label>Nome: <input type="text" name="nome_filme" value="' . htmlspecialchars($_POST['nome_filme'] ?? '') . '"></label><br>
    <label>Diretor: <input type="text" name="diretor" value="' . htmlspecialchars($_POST['diretor'] ?? '') . '"></label><br>
    <label>Descrição: <textarea name="descricao">' . htmlspecialchars($_POST['descricao'] ?? '') . '</textarea></label><br>
    <label>Ano de Lançamento: <input type="text" name="ano_lancamento" value="' . htmlspecialchars($_POST['ano_lancamento'] ?? '') . '"></label><br>
    <label>Gênero: <select name="id_genero">';
echo '<option value="">-- selecione --</option>';
$generos = $dao->listarGeneros();
foreach ($generos as $g) {
    $selected = ($_POST['id_genero'] ?? '') == $g['id_genero'] ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($g['id_genero']) . '" ' . $selected . '>' . htmlspecialchars($g['nome_genero']) . '</option>';
}
echo '</select></label><br>
    <button type="submit">Salvar</button>
    <a href="?entidade=filme&acao=listar">Cancelar</a>
</form>';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../../public/css/style_crud.css">
    <script src="https://kit.fontawesome.com/c25eca0384.js" crossorigin="anonymous"></script>
</head>
<body>
   
</body>
</html>
