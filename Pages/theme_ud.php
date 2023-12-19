<?php
include_once("../Config/database.php");
session_start();

if (isset($_GET["id_s"])) {
    $id_d = $_GET["id_s"];
    $admin->set_themeId($id_d);
    $req = $admin->deleteTheme();
    if ($req) {
        header("location: theme.php");
        exit();
    }
}

if (isset($_GET['id_m'])) {
    $id_u = $_GET['id_m'];
    $admin->set_themeId($id_u);
    $selectIdT = $admin->afficherTheme_u();

    if ($selectIdT) {
        $result = $selectIdT->fetch(PDO::FETCH_ASSOC);

        if (isset($_POST['button'])) {
            $nom_t = $_POST['nom_t'];
            $imgt = $_POST['imgt'];
            $desc_t = $_POST['desc_t'];
            $admin->set_themeName($nom_t);
            $admin->set_themeImage($imgt); 
            $admin->set_themeDesc($desc_t);
            $update_req = $admin->updateTheme();

            if ($update_req) {
                header("location: theme.php");
                exit();
            } else {
                $message = "Erreur : Produit non modifié";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier theme</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="flex">
        <?php include_once("../includes/navbar_admin.php"); ?>
        <div class="form">
            <?php if (isset($result)) : ?>
                <a href="../Pages/produit.php" class="back_btn"><img src="../assets/images/back.png"> Retour</a>
                <h2>Modifier le theme : <?= $result['theme_name'] ?> </h2>
                <p class="erreur_message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </p>
                <form action="" method="POST">
                    <label>Photo du theme</label>
                    <input type="file" name="imgt" value="<?= $result['theme_image'] ?>">
                    <label>Nom theme</label>
                    <input type="text" name="nom_t" value="<?= $result['theme_name'] ?>">
                    <label>Description</label>
                    <input type="text" name="desc_t" value="<?= $result['theme_desc'] ?>">
                    <input type="submit" value="Modifier" name="button">
                </form>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
