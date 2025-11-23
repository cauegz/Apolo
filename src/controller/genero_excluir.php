<?php
require_once __DIR__ . '/../dao/GeneroDAO.php';
$dao = new GeneroDAO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $dao->excluir($id);
}

header('Location: ?entidade=genero&acao=listar');
exit;
