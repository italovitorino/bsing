<?php
require_once "config.php";

class Conexao
{
  private static $instance;

  private function __construct()
  {
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      try {
        self::$instance = new PDO(
          "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
          DB_USER,
          DB_PASS
        );
      } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
      }
    }

    return self::$instance;
  }
}

$conn = Conexao::getInstance();
