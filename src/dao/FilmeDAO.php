<?php 
// src/dao/LivroDAO.php 
require_once __DIR__ . '/../../config/db.php'; 
class FilmeDAO { 
    private $pdo; 
    public function __construct() { 
        $this->pdo = getPDO(); 
    } 

    public function listarTodosFilmes() { 
        $sql = "SELECT f.id_filme, f.nome_filme, f.diretor, f.descricao, g.nome_genero
                FROM filme f
                JOIN genero g ON f.id_genero = g.id_genero";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function listarGeneros() {
        $stmt = $this->pdo->query(
            "SELECT id_genero, nome_genero FROM GENERO ORDER BY id_genero"
        );
        return $stmt->fetchAll();
    }
 
    public function buscarPorId($id) {
        $sql = "SELECT * FROM filme WHERE id_filme = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os dados do filme como um array associativo
    } 

    public function criarFilme($nome_filme, $diretor, $descricao, $ano_lancamento, $id_genero) { 
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

    public function excluir($id) {
        $sql = "DELETE FROM filme WHERE id_filme = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}