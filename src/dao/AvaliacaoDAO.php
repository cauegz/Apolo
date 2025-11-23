<?php 
// src/dao/AvaliacaoDAO.php
require_once __DIR__ . '/../../config/db.php'; 

class AvaliacaoDAO { 
    private $pdo; 

    public function __construct() { 
        $this->pdo = getPDO(); 
    } 

    // Lista todas as avaliações
    public function listarTodasAvaliacoes() { 
        $stmt = $this->pdo->query(
            "SELECT id_avaliacao, id_aluno, id_filme, nota, comentario, data_avaliacao 
             FROM AVALIACAO 
             ORDER BY id_avaliacao DESC"
        ); 
        return $stmt->fetchAll(); 
    } 

    // Lista alunos (necessário para criar avaliação)
    public function listarAlunos() {
        $stmt = $this->pdo->query(
            "SELECT id_aluno, nome 
             FROM ALUNO 
             ORDER BY nome"
        );
        return $stmt->fetchAll();
    }

    // Lista filmes (necessário para criar avaliação)
    public function listarFilmes() {
        $stmt = $this->pdo->query(
            "SELECT id_filme, nome_filme 
             FROM FILME 
             ORDER BY nome_filme"
        );
        return $stmt->fetchAll();
    }

    // Busca avaliação por ID
    public function buscarPorId($id_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "SELECT id_avaliacao, id_aluno, id_filme, nota, comentario, data_avaliacao 
             FROM AVALIACAO 
             WHERE id_avaliacao = ?"
        ); 
        $stmt->execute(array($id_avaliacao)); 
        return $stmt->fetch(); 
    } 

    // Cria nova avaliação
    public function criarAvaliacao($id_avaliacao, $id_aluno, $id_filme, $nota, $comentario, $data_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "INSERT INTO AVALIACAO (id_aluno, id_filme, nota, comentario, data_avaliacao) 
             VALUES (?, ?, ?, ?, ?)"
        ); 

        $stmt->execute(array(
            $id_aluno,
            $id_filme,
            $nota,
            $comentario,
            $data_avaliacao
        ));

        return $this->pdo->lastInsertId(); 
    } 

    // Atualiza avaliação
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

    // Exclui avaliação
    public function excluir($id_avaliacao) { 
        $stmt = $this->pdo->prepare(
            "DELETE FROM AVALIACAO WHERE id_avaliacao = ?"
        ); 
        return $stmt->execute(array($id_avaliacao)); 
    } 
}
