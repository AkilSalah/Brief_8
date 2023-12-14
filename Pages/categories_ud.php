<?php
require_once("../Config/database.php");

if (isset($_GET['id_s'])) {
    $id_d = $_GET['id_s'];
    $result = $admin->deleteCategory($id_d);
    header("location: categorie.php");
}

if (isset($_GET['id_m'])) {
    $id_u = $_GET['id_m'];
    $result = $admin->afficherCategory(); 

    if ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
        if (isset($_POST['button'])) {
            $nom = $_POST['nom'];

            if (!empty($nom)) {
                $req_update = $admin->updateCategory($id_u, $nom);
                if ($req_update) {
                    header("location: categories.php");
                } else {
                    $message = "Erreur : Catégorie non modifiée";
                }
            } else {
                $message = "Veuillez remplir le champ du nom de la catégorie";
            }
        }
    } else {
        $message = "ID de catégorie non trouvé.";
    }
} else {
    $message = "ID de catégorie manquant.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier catégorie</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="flex">
        <?php include_once("../includes/navbar_admin.php"); ?>
        <div class="form">
            <a href="cat_admin.php" class="back_btn"><img src="img/back.png"> Retour</a>
            <?php if (isset($row)): ?>
                <h2>Modifier la catégorie : <?= $row['name'] ?> </h2>
                <p class="erreur_message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </p>
                <form action="" method="POST">
                    <label>Nom catégorie</label>
                    <input type="text" name="nom" value="<?= $row['name'] ?>">
                    <input type="submit" value="Modifier" name="button">
                </form>
            <?php else: ?>
                <p>ID de catégorie non trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
