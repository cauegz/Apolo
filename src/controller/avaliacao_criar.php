<?php
// Importa os DAOs necessários para operar avaliações e carregar as listas de alunos e filmes
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';
require_once __DIR__ . '/../dao/AlunoDAO.php';
require_once __DIR__ . '/../dao/FilmeDAO.php';

// Instancia os objetos de acesso a dados
$avaliacaoDao = new AvaliacaoDAO();
$alunoDao = new AlunoDAO();
$filmeDao = new FilmeDAO();

// Carrega as listas para preencher os <select> (Foreign Keys)
// Isso atende ao requisito de relacionamentos do roteiro (item 10)
$listaAlunos = $alunoDao->listarTodos();
$listaFilmes = $filmeDao->listarTodos();

// Lógica de Processamento do Formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização básica das entradas
    $id_aluno   = trim(isset($_POST['id_aluno']) ? $_POST['id_aluno'] : '');
    $id_filme   = trim(isset($_POST['id_filme']) ? $_POST['id_filme'] : '');
    $nota       = trim(isset($_POST['nota']) ? $_POST['nota'] : '');
    $comentario = trim(isset($_POST['comentario']) ? $_POST['comentario'] : '');

    $erros = array();

    // Validações Obrigatórias
    if ($id_aluno === '') $erros[] = 'Selecione um aluno.';
    if ($id_filme === '') $erros[] = 'Selecione um filme.';
    
    // Validação da Nota (Inteiro entre 1 e 5)
    if ($nota === '' || !ctype_digit($nota)) {
        $erros[] = 'A nota deve ser um número inteiro.';
    } elseif ((int)$nota < 1 || (int)$nota > 5) {
        $erros[] = 'A nota deve ser entre 1 e 5.';
    }

    // Se não houver erros, tenta inserir no banco
    if (empty($erros)) {
        // A data da avaliação geralmente é a data atual
        $data_avaliacao = date('Y-m-d');
        
        try {
            // Chama o método criar do DAO (assumindo a assinatura padrão do roteiro)
            $avaliacaoDao->criar((int)$id_aluno, (int)$id_filme, (int)$nota, $comentario, $data_avaliacao);
            
            // Redireciona para a listagem em caso de sucesso
            header('Location: ?entidade=avaliacao&acao=listar');
            exit;
        } catch (Exception $e) {
            // Captura erro de chave única (mesmo aluno avaliando mesmo filme)
            $erros[] = 'Erro ao salvar: ' . $e->getMessage();
        }
    }
}
?>

<?php if (!empty($erros)): ?>
    <div style="color:red; text-align: center; margin-bottom: 10px;">
        <?php echo implode('<br>', array_map('htmlspecialchars', $erros)); ?>
    </div>
<?php endif; ?>

<h1>Nova Avaliação</h1>

<main>
    <div class="conteudo_crud">
        <form method="post" class="form_crud">
            
            <label>Aluno: 
                <select name="id_aluno" class="input_crud">
                    <option value="">-- selecione o aluno --</option>
                    <?php foreach ($listaAlunos as $aluno): ?>
                        <option value="<?php echo htmlspecialchars($aluno['id_aluno']); ?>"
                            <?php echo (isset($_POST['id_aluno']) && $_POST['id_aluno'] == $aluno['id_aluno']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($aluno['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>Filme: 
                <select name="id_filme" class="input_crud">
                    <option value="">-- selecione o filme --</option>
                    <?php foreach ($listaFilmes as $filme): ?>
                        <option value="<?php echo htmlspecialchars($filme['id_filme']); ?>"
                            <?php echo (isset($_POST['id_filme']) && $_POST['id_filme'] == $filme['id_filme']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($filme['nome_filme']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>Nota (1 a 5): 
                <select name="nota" class="input_crud">
                    <option value="">-- nota --</option>
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>" 
                            <?php echo (isset($_POST['nota']) && $_POST['nota'] == $i) ? 'selected' : ''; ?>>
                            <?php echo $i; ?> Estrela(s)
                        </option>
                    <?php endfor; ?>
                </select>
            </label>

            <label>Comentário: 
                <textarea name="comentario" rows="4" class="input_crud" placeholder="Escreva sua opinião..."><?php echo isset($_POST['comentario']) ? htmlspecialchars($_POST['comentario']) : ''; ?></textarea>
            </label>

            <button type="submit" class="botao_crud">Salvar Avaliação</button>
            <a href="?entidade=avaliacao&acao=listar" class="botao_crud">Cancelar</a>
            
        </form>
    </div>
</main>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Avaliação</title>
    <style>
        .form_crud {
            display: flex;
            flex-direction: column;
            width: 300px; /* Ajuste para visualização melhor */
            margin: 0 auto;
        }
        .input_crud {
            margin-bottom: 10px;
            padding: 5px;
        }
        .botao_crud {
            margin-top: 10px;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        h1 { text-align: center; }
    </style>
</head>
<body></body>
</html>