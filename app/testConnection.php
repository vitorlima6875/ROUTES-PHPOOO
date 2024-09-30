<?php
// Arquivo: testConnection.php
require 'path/to/connection.php'; // Substitua pelo caminho correto da sua classe connection

use App\Database\connection;

// Teste a conexão com o banco de dados
try {
    $conn = connection::connect(); // Tenta conectar
    echo "Conexão com o banco de dados foi bem-sucedida!";
} catch (Exception $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}
