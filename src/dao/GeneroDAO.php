<?php
// src/dao/GeneroDAO.php
require_once __DIR__ . '/../../config/db.php';

class GeneroDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    // Listar todos os gêneros
    public function listarTodos() {
        $stmt = $this->pdo->query(
            "SELECT id_genero, nome_genero 
             FROM GENERO 
             ORDER BY id_genero DESC"
        );
        return $stmt->fetchAll();
    }

    // Buscar um gênero pelo ID
    public function buscarPorId($id_genero) {
        $stmt = $this->pdo->prepare(
            "SELECT id_genero, nome_genero 
             FROM GENERO 
             WHERE id_genero = ?"
        );
        $stmt->execute(array($id_genero));
        return $stmt->fetch();
    }

    // Criar novo gênero
    public function criar($id_genero, $nome_genero) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO GENERO (id_genero, nome_genero) 
             VALUES (?, ?)"
        );
        return $stmt->execute(array($id_genero, $nome_genero));
    }

    // Atualizar um gênero existente
    public function atualizar($id_genero, $nome_genero) {
        $stmt = $this->pdo->prepare(
            "UPDATE GENERO 
             SET nome_genero = ?
             WHERE id_genero = ?"
        );
        return $stmt->execute(array($nome_genero, $id_genero));
    }

    // Excluir gênero
    public function excluir($id_genero) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM GENERO WHERE id_genero = ?"
        );
        return $stmt->execute(array($id_genero));
    }
}
