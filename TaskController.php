<?php
include 'TaskModel.php';

class TaskController {
    private $model;

    public function __construct($connection) {
        $this->model = new TaskModel($connection);
    }

    public function handleRequest() {
        if (isset($_POST['add'])) {
            $this->model->addTask($_POST['titre'], $_POST['description']);
            header("Location: index.php");
            exit();
        }

        if (isset($_POST['edit_task'])) {
            $this->model->updateTask($_POST['id'], $_POST['titre'], $_POST['description']);
            header("Location: index.php");
            exit();
        }

        if (isset($_POST['terminer'])) {
            $this->model->updateTask($_POST['id'], $_POST['titre'], $_POST['description']);
        }

        if (isset($_POST['supprimer'])) {
            $this->model->deleteTask($_POST['id']);
        }
    }

    public function getTasks() {
        return $this->model->getAllTasks();
    }
}
?>
