<?php 
// src/dao/AvaliacaoDAO.php
require_once __DIR__ . '/../../config/db.php'; 

class AvaliacaoDAO { 
    private $pdo; 

    public function __construct() { 
        $this->pdo = getPDO(); 
    } 

    public function listarTodasAvaliacoes() { 
        $stmt = $this->pdo->query(
            "SELECT 
                id_avaliacao, 
                id_aluno, 
                id_filme, 
                nota, 
                comentario, 
                data_avaliacao 
             FROM AVALIACAO 
             ORDER BY id_avaliacao DESC"
        ); 
        return $stmt->fetchAll(); 
    } 

    public function buscarPorId($id_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "SELECT 
                id_avaliacao, 
                id_aluno, 
                id_filme, 
                nota, 
                comentario, 
                data_avaliacao 
             FROM AVALIACAO 
             WHERE id_avaliacao = ?"
        ); 
        $stmt->execute(array($id_avaliacao)); 
        return $stmt->fetch(); 
    } 

    public function criarAvaliacao($id_avaliacao, $id_aluno, $id_filme, $nota, $comentario, $data_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "INSERT INTO AVALIACAO 
                (id_aluno, id_filme, nota, comentario, data_avaliacao) 
             VALUES (?, ?, ?, ?, ?)"
        ); 
        $stmt->execute(array($id_aluno, $id_filme, $nota, $comentario, $data_avaliacao)); 

        return $this->pdo->lastInsertId(); 
    } 

    public function atualizar($id_avaliacao, $id_aluno, $id_filme, $nota, $comentario, $data_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "UPDATE AVALIACAO 
             SET id_aluno = ?, id_filme = ?, nota = ?, comentario = ?, data_avaliacao = ?
             WHERE id_avaliacao = ?"
        ); 

        return $stmt->execute(array(
            $id_aluno,
            $id_filme,
            $nota,
            $comentario,
            $data_avaliacao,
            $id_avaliacao
        )); 
    } 

    public function excluir($id_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "DELETE FROM AVALIACAO WHERE id_avaliacao = ?"
        ); 
        return $stmt->execute(array($id_avaliacao)); 
    } 
}
