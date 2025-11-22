<?php
require_once __DIR__ . '/../config/db.php';

// Roteamento exatamente como no roteiro
$entidade = isset($_GET['entidade']) ? $_GET['entidade'] : 'home';
$acao     = isset($_GET['acao']) ? $_GET['acao'] : 'index';

$arquivo = __DIR__ . '/../src/controller/' . $entidade . '_' . $acao . '.php';

if (!($entidade === 'home' && $acao === 'index')) {
    if (file_exists($arquivo)) {
        require $arquivo;
        exit;
    } else {
        echo 'Rota não encontrada';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Avaliação de Filmes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="card">
    <h1>Sistema de Avaliação de Filmes</h1>
    <h3>Escolha uma entidade:</h3   >

    <h2><a href="?entidade=filme&acao=listar">Filmes</a></h2>

    <h2><a href="?entidade=genero&acao=listar">Gêneros</a></h2>
    
    <h2><a href="?entidade=aluno&acao=listar">Alunos</a></h2>

    <h2><a href="?entidade=avaliacao&acao=listar">Avaliações</a></h2>
</div>

</body>
</html>
