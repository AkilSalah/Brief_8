<?php
require_once("../Config/database.php");

if(isset ($_POST["button"])){

    $category= $_POST["nom_cat"];
    $admin->set_categorieNom($category);
    $result = $admin->addCategory();
    
    if ($result) {
        $message=   "La catégorie a été ajoutée avec succès.";
      } else {
        $message=   "Erreur : La catégorie n'a pas pu être ajoutée.";
      }
  }else{
      $message = "Veuillez remplir tous les champs !";
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Ajouter Categorie</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

</head>

<body>
    <div class="flex">
    <?php 
    include_once  ("../includes/navbar_admin.php");
    ?>
        <div class="form">
           
            <h2>Ajouter une catégorie </h2>
            <p class="erreur_message">
            <?php
            if(isset($message)){
                echo "".$message."";
            }
            ?>
            </p>
            <form action="" method="POST">
                <label>Nom de catégorie</label>
                <input type="text" name="nom_cat">
                <input type="submit" value="Ajouter" name="button">
            </form>
            <table>

                <tr id="items">
                    <th>Id catégorie</th>
                    <th>Nom catégorie</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php

                $result = $admin->afficherCategory();
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_cat'] . "</td>";
                    echo "<td>" . $row['name_cat'] . "</td>";
                    echo "<td><a class='table-link' href='categories_ud.php?id_m=".$row['id_cat']."'><img src='../assets/images/pen.png'></a></td>";
                    echo "<td><a class='table-link' href='categories_ud.php?id_s=".$row['id_cat']."'><img src='../assets/images/trash.png'></a></td>";
                    echo "</tr>";
                }

                ?>
               

            </table>

        </div>


    </div>



</body>

</html>