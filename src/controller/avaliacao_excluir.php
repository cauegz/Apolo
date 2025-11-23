<?php
require_once __DIR__ . '/../dao/AvaliacaoDAO.php';
$dao = new AvaliacaoDAO();

$id = isset($_GET['id_avaliacao']) ? (int)$_GET['id_avaliacao'] : 0;

if ($id > 0) {
    $dao->excluir($id);
}

header('Location: ?entidade=avaliacao&acao=listar');
exit;