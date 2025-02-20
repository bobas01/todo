<?php
$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS todoList";
if ($conn->query($sql) === TRUE) {
    echo "Base de données créée avec succès<br>";
}

$conn->select_db("todoList");


$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    statut BOOLEAN NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table créée avec succès";
} else {
    echo "Erreur lors de la création de la table: " . $conn->error;
}

$conn->close();
?>
