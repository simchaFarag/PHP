<?php
class Database {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function select($table, $columns = '*', $where = '') {
        $query = "SELECT $columns FROM $table";
        if (!empty($where)) {
            $query .= " WHERE $where";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array_values($data));
        return $this->pdo->lastInsertId();
    }

    public function delete($table, $where) {
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function update($table, $data, $where) {
        $set = implode(', ', array_map(function($key, $value) {
            return "$key = ?";
        }, array_keys($data), $data));
        $query = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }
}

// שימוש במחלקה עם החיבור הקיים
$pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$database = new Database($pdo);

// דוגמאות לשימוש במתודות
$users = $database->select("Users");
$newUserId = $database->insert("Users", ["name" => "John", "email" => "john@example.com", "active" => true]);
$deletedRows = $database->delete("Users", "id = 1");
$updatedRows = $database->update("Users", ["name" => "NewName"], "id = 2");
?>