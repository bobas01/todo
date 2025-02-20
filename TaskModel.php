<?php
class TaskModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getAllTasks() {
        $sql = "SELECT * FROM tasks";
        return $this->conn->query($sql);
    }

    public function addTask($titre, $description) {
        $stmt = $this->conn->prepare("INSERT INTO tasks (titre, description, statut) VALUES (?, ?, 0)");
        $stmt->bind_param("ss", $titre, $description);
        return $stmt->execute();
    }

    public function updateTask($id, $titre, $description) {
        $stmt = $this->conn->prepare("UPDATE tasks SET titre = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $titre, $description, $id);
        return $stmt->execute();
    }

    public function deleteTask($id) {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
