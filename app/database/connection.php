<?php

namespace   App\Database;

use PDO;
use PDOException;

class connection
{  private static $connection = null; // Inicialmente null para indicar que não há conexão ativa
    
    public static function connect()
    {
        // Verifica se a conexão já foi estabelecida
        if (self::$connection === null) {
            try {
                // Cria a nova conexão PDO
                self::$connection = new PDO("mysql:host=localhost;dbname=rotasphp4", "root", "1234", [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Define o modo de erro para exceções
                ]);
            } catch (PDOException $e) {
                // Trata erros de conexão
                die("Erro de conexão: " . $e->getMessage());
            }
        }

        // Retorna a conexão estabelecida
        return self::$connection;
    }
}