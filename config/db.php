<?php

function getPDO() {
 $host = '127.0.0.1';
 $db = 'avfilmes';
 $user = 'root'; 
 $pass = '';
 $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
 try {
 $pdo = new PDO($dsn, $user, $pass);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 
PDO::FETCH_ASSOC);
 return $pdo;
 } catch (PDOException $e) {
 die('Erro de conexão: ' . $e->getMessage());
 }
}