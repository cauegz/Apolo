<?php
require_once __DIR__ . '/../../config/db.php';

class AlunoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT id_aluno, nome, email FROM ALUNO ORDER BY id_aluno DESC");
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id_aluno, nome, email FROM ALUNO WHERE id_aluno = ?");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    public function criar($nome, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO ALUNO (nome, email) VALUES (?, ?)");
        $stmt->execute(array($nome, $email));
        return $this->pdo->lastInsertId();
    }

    public function atualizar($id, $nome, $email) {
        $stmt = $this->pdo->prepare("UPDATE ALUNO SET nome = ?, email = ? WHERE id_aluno = ?");
        return $stmt->execute(array($nome, $email, $id));
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM ALUNO WHERE id_aluno = ?");
        return $stmt->execute(array($id));
    }
}
?>