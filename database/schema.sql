CREATE DATABASE IF NOT EXISTS avfilmes DEFAULT CHARACTER SET utf8; 
USE avfilmes;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS GENERO;
DROP TABLE IF EXISTS ALUNO;
DROP TABLE IF EXISTS FILME;
DROP TABLE IF EXISTS AVALIACAO;


CREATE TABLE GENERO (
    id_genero INT PRIMARY KEY,
    nome_genero VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE ALUNO (
    id_aluno INT  PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL 
);


CREATE TABLE FILME (
    id_filme INT PRIMARY KEY,
    nome_filme VARCHAR(100) NOT NULL UNIQUE, 
    diretor VARCHAR(150),
    descricao VARCHAR(300),
    ano_lancamento INT,
    id_genero INT NOT NULL, 
    FOREIGN KEY (id_genero) REFERENCES GENERO(id_genero)
);


CREATE TABLE AVALIACAO (
    id_avaliacao INT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_filme INT NOT NULL,
    nota INT NOT NULL CHECK (nota BETWEEN 1 AND 5), 
    comentario VARCHAR(300),                               
    data_avaliacao DATE,
    UNIQUE (id_aluno, id_filme),
    FOREIGN KEY (id_aluno) REFERENCES ALUNO(id_aluno),
    FOREIGN KEY (id_filme) REFERENCES FILME(id_filme)
);
SET FOREIGN_KEY_CHECKS = 1;