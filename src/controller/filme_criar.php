<?php 
require_once __DIR__ . '/../dao/avfilmDAO.php'; 
$dao = new avfilmDAO(); 

// carregar lista de gêneros para o select
$generos = $dao->listarGeneros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nome_filme     = trim(isset($_POST['nome_filme']) ? $_POST['nome_filme'] : ''); 
    $diretor        = trim(isset($_POST['diretor']) ? $_POST['diretor'] : ''); 
    $descricao      = trim(isset($_POST['descricao']) ? $_POST['descricao'] : ''); 
    $ano_lancamento = trim(isset($_POST['ano_lancamento']) ? $_POST['ano_lancamento'] : ''); 
    $id_genero      = trim(isset($_POST['id_genero']) ? $_POST['id_genero'] : ''); 

    $erros = array(); 
    if ($nome_filme === '') $erros[] = 'Nome do filme é obrigatório'; 
    if ($diretor === '') $erros[] = 'Diretor é obrigatório'; 
    if ($ano_lancamento === '' || !ctype_digit($ano_lancamento)) $erros[] = 'Ano de lançamento deve ser numérico'; 

    // validar que o gênero selecionado existe
    $validGeneroIds = array_map('strval', array_column($generos, 'id_genero'));
    if ($id_genero === '' || !in_array((string)$id_genero, $validGeneroIds)) {
        $erros[] = 'Gênero inválido';
    }

    if (empty($erros)) { 
        $dao->criarFilme(null, $nome_filme, $diretor, $descricao, (int)$ano_lancamento, (int)$id_genero); 
        header('Location: ?entidade=filme&acao=listar'); 
        exit; 
    } 
} 

echo '<h1>Novo Filme</h1>'; 
if (!empty($erros)) { 
    echo '<div style="color:red;">'.implode('<br>', array_map('htmlspecialchars', $erros)).'</div>'; 
} 

// renderizar formulário com select de gêneros
echo '<form method="post"> 
<label>Nome: <input type="text" name="nome_filme"></label><br> 
<label>Diretor: <input type="text" name="diretor"></label><br> 
<label>Descrição: <input type="text" name="descricao"></label><br> 
<label>Ano de Lançamento: <input type="text" name="ano_lancamento"></label><br> 
<label>Gênero: <select name="id_genero" id="id_genero" title="Escolha um gênero">';
// placeholder
echo '<option value="">-- selecione --</option>';
if (empty($generos)) {
    echo '<option value="" disabled>Nenhum gênero cadastrado</option>';
} else {
    foreach ($generos as $g) {
        echo '<option value="'.htmlspecialchars($g['id_genero']).'">'.htmlspecialchars($g['nome_genero']).'</option>';
    }
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
    <title>filmesadicionar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
</body>
</html>