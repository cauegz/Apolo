<?php
require_once __DIR__ . '/../dao/FilmeDAO.php';
$dao = new FilmeDAO();

$id = isset($_GET['id_filme']) ? (int)$_GET['id_filme'] : 0;

if ($id > 0) {
    $dao->excluir($id);
}

header('Location: ?entidade=filme&acao=listar');
exit;