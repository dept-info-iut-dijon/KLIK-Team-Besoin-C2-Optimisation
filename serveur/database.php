<?php
class Database {
    private string $host = "localhost";
    private string $db_name = "klik_database";
    private string $username = "root";
    private string $password = "";
    private PDO $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }

    public function query(string $query, array $params = []): array|false
    {
        $r = $this->pdo->prepare($query);
        $r->execute($params);

        return $r->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $query, array $params = []): void
    {
        $r = $this->pdo->prepare($query);
        $r->execute($params);
    }

    public function rollBack(): void
    {
        $this->pdo->rollBack();
    }

    public function commit(): void
    {
        $this->pdo->commit();
    }
}
