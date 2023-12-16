<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Ajouter produit</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="flex">
        <?php
        include_once("../includes/navbar_admin.php");
        include_once("../Config/database.php");
        ?>
        <div class="form">
            <?php
            if (isset($_POST["button"]) && !empty($_POST["nom_cat"]) && !empty($_POST["nom_pro"]) && !empty($_POST["prix_pro"])) {
                $img_pro = $_POST["imgp"];
                $id_cat = $_POST["nom_cat"];
                $nom_pro = $_POST["nom_pro"];
                $prix_pro = $_POST["prix_pro"];
                $req = $admin->addProduct($img_pro,$nom_pro,$prix_pro,$id_cat);
                if ($req) {
                    $message = "Le produit a été ajouté avec succès.";
                    header("Location: produit.php");
                    exit();
                } else {
                    $message = "Erreur : Le produit n'a pas pu être ajouté.";
                }
            } else {
                $message = "Veuillez remplir tous les champs !";
            }
            ?>
            <h2>Ajouter un produit </h2>
            <p class="erreur_message">
                <?php
                if (isset($message)) {
                    echo "" . $message . "";
                }
                ?>
            </p>
            <form action="" method="POST">
                <label>Photo du produit</label>
                <input type="file" name="imgp" required>
                <label>Nom de produit</label >
                <input type="text" name="nom_pro" required>
                <label>Prix de produit</label>
                <input type="number" name="prix_pro">
                <label for="category">Categorie</label>
                <select id="category" name="nom_cat">
                    <option selected disabled>Choisir une categorie</option>
                    <?php
                    $cat = $admin->afficherCategory();
                    foreach ($cat as $row){
                    ?>
                        <option value="<?= $row["id_cat"] ?>"> <?= $row["name_cat"] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="Ajouter" name="button">
            </form>
            <table>
                <tr id="items">
                    <th>Photo du produit</th>
                    <th>Nom produit</th>
                    <th>Nom de catégorie</th>
                    <th>Prix de produit</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $result = $admin->afficherProduct();
                foreach($result as $row) {
                ?>
                    <tr>
                        <div class="image" >
                        <td><img src="../assets/images/<?=$row["image_url"] ?>" alt=""></td>
                        </div>
                        <td><?= $row["name_plant"] ?> </td>
                        <td><?= $row["name_cat"] ?> </td>
                        <td><?= $row["price"] ?> </td>
                        <td><a class='table-link' href='../Pages/produit_ud.php?id_m=<?=$row['id_plant'] ?>'><img src='../assets/images/pen.png'></a></td>
                        <td><a class='table-link' href='../Pages/produit_ud.php?id_s=<?=$row['id_plant'] ?>'><img src='../assets/images/trash.png'></a></td>

                         </tr>
                <?php
                }
                ?>
              
            </table>
        </div>
        
    </div>
</body> 

</html>
