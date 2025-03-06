<?php

namespace Aries\Dbmodel\Models;

use Aries\Dbmodel\Includes\Database;


class To_do extends Database {
    private $db;

    public function __construct() {
        parent::__construct(); // Call the parent constructor to establish the connection
        $this->db = $this->getConnection(); // Get the connection instance
    }

    public function getTasks() {
        $sql = "SELECT * FROM todo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTask($id) {
        $sql = "SELECT * FROM todo WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function createTask($data) {
        $sql = "INSERT INTO todo (task_name) VALUES (:name)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name' => $data['name']
        ]);
        return $this->db->lastInsertId();
    }

    public function updateTask($data) {
        $sql = "UPDATE todo SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $data['id'],
            'name' => $data['name']
        ]);
        return "Record UPDATED successfully";
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return "Record DELETED successfully";
    }   
}
