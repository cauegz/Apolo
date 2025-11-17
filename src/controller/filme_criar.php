<?php 
require_once __DIR__ . '/../dao/FilmeDAO.php'; 
$dao = new FilmeDAO(); 

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

    $validGeneroIds = array_map('strval', array_column($generos, 'id_genero'));
    if ($id_genero === '' || !in_array((string)$id_genero, $validGeneroIds)) {
        $erros[] = 'Gênero inválido';
    }

    if (empty($erros)) { 
        $dao->criarFilme($nome_filme, $diretor, $descricao, (int)$ano_lancamento, (int)$id_genero); 
        header('Location: ?entidade=filme&acao=listar'); 
        exit; 
    } 
} 


if (!empty($erros)) { 
    echo '<div style="color:red;">'.implode('<br>', array_map('htmlspecialchars', $erros)).'</div>'; 
} 

echo '<main><div class="conteudo_crud"><form method="post" class="form_crud"> 
<label>Nome: <input type="text" name="nome_filme" class="input_crud"></label>
<label>Diretor: <input type="text" name="diretor" class="input_crud"></label>
<label>Descrição: <input type="text" name="descricao" class="input_crud"></label>
<label>Ano de Lançamento: <input type="text" name="ano_lancamento" class="input_crud"></label>
<label>Gênero: <select name="id_genero" id="id_genero" title="Escolha um gênero" class="input_crud">';
echo '<option value="">-- selecione --</option>';
if (empty($generos)) {
    echo '<option value="" disabled>Nenhum gênero cadastrado</option>';
} else {
    foreach ($generos as $g) {
        echo '<option value="'.htmlspecialchars($g['id_genero']).'">'.htmlspecialchars($g['nome_genero']).'</option>';
    }
}
echo '</select></label>
<button type="submit" class="botao_crud">Salvar</button> 
<a href="?entidade=filme&acao=listar" class="botao_crud">Cancelar</a> 
</form>';
echo '<h1>Novo Filme</h1></div></main>'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar um filme</title>
    <link rel="stylesheet" href="../../public/css/style_crud.css">
    <script src="https://kit.fontawesome.com/c25eca0384.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1 class="titulo-cabecalho"><a href="index.php">Apolo</a>
        </h1>
        <div class="login-cabecalho">
            <i class="fa-solid fa-user icone-usuario"></i>
            <h3>Registro</h3>
        </div>
    </header>

   
</body>
</html>