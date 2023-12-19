<?php
include_once("../Config/database.php");

if (isset($_GET["id_s"])) {
    $id_d = $_GET["id_s"];
    $admin->set_productId($id_d);
    $req = $admin->deleteProduct();
    if ($req) {
        header("location: produit.php");
        exit();
    }
}


if (isset($_GET['id_m'])) {
    $id_u = $_GET['id_m'];
    $admin->set_productId($id_u);
    $result = $admin->afficherProduit_u();

    if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        if (isset($_POST['button'])) {
            $nom_p = $_POST['nom_p'];
            $prix = $_POST['prix'];
            $img = $_POST['imgp'];
            $nom_c = $_POST['nom_cat'];
            // die($nom_c);
            if (!empty($nom_p)) { 
                $admin->set_productName($nom_p);
                $admin->set_productPrice($prix);
                $admin->set_productImage($img);
                $admin->set_categorieId($nom_c);
                $req_update = $admin->updateProduct();
                if ($req_update) {
                    header("location: produit.php");
                    exit();
                } else {
                    $message = "Erreur : Produit non modifié";
                }
            } else {
                $message = "Veuillez remplir le champ du nom du produit";
            }
        }
    } else {
        $message = "ID de produit non trouvé.";
    }
} else {
    $message = "ID de produit manquant.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier produit</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="flex">
        <?php
        include_once("../includes/navbar_admin.php");
        ?>
        <div class="form">
            <?php if (isset($row)): ?>
                <a href="../Pages/produit.php" class="back_btn"><img src="../assets/images/back.png"> Retour</a>
                <h2>Modifier le produit : <?= $row['name_plant'] ?> </h2>
                <p class="erreur_message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </p>
                <form action="" method="POST">
                    <label>Photo du produit</label>
                    <input type="file" name="imgp" value="<?= $row['image_url'] ?>">
                    <label>Nom produit</label>
                    <input type="text" name="nom_p" value="<?= $row['name_plant'] ?>">
                    <label for="category">Categorie</label>
                    <select name="nom_cat">
                        <option selected disabled>Choisir une categorie</option>
                        <?php
                        $cat = $admin->afficherCategory();
                        foreach ($cat as $all_cat) {
                            ?>
                            <option value="<?= $all_cat["id_cat"] ?>"> <?= $all_cat["name_cat"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label>Prix de produit</label>
                    <input type="text" name="prix" value="<?= $row['price'] ?>">
                    <input type="submit" value="Modifier" name="button">
                </form>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
