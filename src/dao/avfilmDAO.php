<?php 
// src/dao/LivroDAO.php 
require_once __DIR__ . '/../../config/db.php'; 
class avfilmDAO { 
    private $pdo; 
    public function __construct() { 
        $this->pdo = getPDO(); 
    } 

    public function listarTodosFilmes() { 
        $stmt = $this->pdo->query(
            "SELECT id_filme, nome_filme, diretor, descricao, ano_lancamento, id_genero FROM FILME ORDER BY id_filme DESC"
        ); 
        return $stmt->fetchAll(); 
    } 

    public function listarGeneros() {
        $stmt = $this->pdo->query(
            "SELECT id_genero, nome_genero FROM GENERO ORDER BY id_genero"
        );
        return $stmt->fetchAll();
    }
 
    public function buscarPorId($id_filme) { 
        $stmt = $this->pdo->prepare(
            "SELECT id_filme, nome_filme, diretor, descricao, ano_lancamento, id_genero FROM FILME WHERE id_filme = ?"
        ); 
        $stmt->execute(array($id_filme)); 
        return $stmt->fetch(); 
    } 

    public function criarFilme($id_filme, $nome_filme, $diretor, $descricao, $ano_lancamento, $id_genero) { 
        $stmt = $this->pdo->prepare(
            "INSERT INTO FILME (nome_filme, diretor, descricao, ano_lancamento, id_genero) VALUES (?, ?, ?, ?, ?)"
        ); 
        $stmt->execute(array($nome_filme, $diretor, $descricao, $ano_lancamento, $id_genero)); 
        return $this->pdo->lastInsertId(); 
    } 

    public function atualizar($id_filme, $nome_filme, $diretor, $descricao, $ano_lancamento, $id_genero) { 
        $stmt = $this->pdo->prepare(
            "UPDATE FILME SET nome_filme = ?, diretor = ?, descricao = ?, ano_lancamento = ?, id_genero = ? WHERE id_filme = ?"
        ); 
        return $stmt->execute(array($nome_filme, $diretor, $descricao, $ano_lancamento, $id_genero, $id_filme)); 
    } 

    public function excluir($id_filme) { 
        $stmt = $this->pdo->prepare("DELETE FROM FILME WHERE id_filme = ?"); 
        return $stmt->execute(array($id_filme)); 
    } 
}