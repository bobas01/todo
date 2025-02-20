<?php
include 'Connection.php';
include 'TaskController.php';

$controller = new TaskController($conn);
$controller->handleRequest();
$result = $controller->getTasks();


$titreEdit = '';
$descriptionEdit = '';
$idEdit = null;


if (isset($_POST['edit'])) {
    $idEdit = $_POST['id'];
    $titreEdit = $_POST['titre'];
    $descriptionEdit = $_POST['description'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Tâches</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <h1>Liste de Tâches</h1>
    <div class="container_add">
        <form method="post" class="form_add">
            <div class="form_add_input">
                <input class="input_task" type="text" name="titre" placeholder="Titre" required>
                <textarea class="input_task" name="description" placeholder="Description" required></textarea>
            </div>
            <button type="submit" name="add" class="add_task">Ajouter une tâche</button>
        </form>
    </div>

    <?php if ($idEdit !== null): ?>
    <div class="container_edit">
        <form method="post" class="form_add">
            <div class="form_add_input">
                <input class="input_task" type="text" name="titre" value="<?php echo htmlspecialchars($titreEdit); ?>" required>
                <textarea class="input_task" name="description" required><?php echo htmlspecialchars($descriptionEdit); ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $idEdit; ?>">
            <button type="submit" name="edit_task" class="add_task">Modifier</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="container_todo">
            <h2>Tâches à faire</h2>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php if ($row['statut'] == 0): ?>
                        <li>
                            <?php echo htmlspecialchars($row['titre']); ?> - <?php echo htmlspecialchars($row['description']); ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="titre" value="<?php echo htmlspecialchars($row['titre']); ?>">
                                <input type="hidden" name="description" value="<?php echo htmlspecialchars($row['description']); ?>">
                                <button type="submit" name="edit" class="button_edit button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" name="terminer" class="button_done button">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="supprimer" class="button_delete button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="container_done">
            <h2>Tâches Terminées</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM tasks WHERE statut = 1";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <?php echo htmlspecialchars($row['titre']); ?> - <?php echo htmlspecialchars($row['description']); ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="supprimer" class="button_delete button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>