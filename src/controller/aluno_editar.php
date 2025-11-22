<?php
// src/controller/aluno_editar.php

require_once __DIR__ . '/../dao/AlunoDAO.php';

$dao = new AlunoDAO();

// Obtém o ID da URL, converte para inteiro
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Busca o aluno no banco
$aluno = $dao->buscarPorId($id);

// Se não existir, encerra
if (!$aluno) { echo 'Aluno não encontrado'; exit; }

// Processamento do Formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e sanitiza os dados
    $nome  = trim(isset($_POST['nome']) ? $_POST['nome'] : '');
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');

    $erros = array();

    // Validações
    if ($nome === '') {
        $erros[] = 'Nome é obrigatório';
    }
    if ($email === '') {
        $erros[] = 'Email é obrigatório';
    }

    // Se não houver erros, atualiza e redireciona
    if (empty($erros)) {
        $dao->atualizar($id, $nome, $email);
        header('Location: ?entidade=aluno&acao=listar');
        exit;
    }
    
} else {
    // Se for GET (primeiro acesso), popula o $_POST com os dados do banco
    // Isso permite usar a mesma lógica de 'value' no formulário abaixo
    $_POST = $aluno;
}

echo '<h1>Editar Aluno</h1>';

// Exibe erros, se houver
if (!empty($erros)) {
    echo '<div style="color:red;">'.implode('<br>', array_map('htmlspecialchars', $erros)).'</div>';
}

// Formulário de Edição
// Nota: O action é omitido para postar na mesma URL (?entidade=aluno&acao=editar&id=...)
echo '<form method="post">
    <label>Nome: <input type="text" name="nome" 
           value="'.htmlspecialchars(isset($_POST['nome']) ? $_POST['nome'] : '').'"></label><br>
           
    <label>Email: <input type="text" name="email" 
           value="'.htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : '').'"></label><br>
           
    <button type="submit">Salvar</button>
    <a href="?entidade=aluno&acao=listar">Cancelar</a>
</form>';
?>