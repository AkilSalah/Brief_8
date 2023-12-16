<?php
include_once("../Config/database.php");
session_start();
if(isset($_POST["button"])){
    $t_image = $_POST['imgt'];
    $t_name = $_POST["nom_theme"];
    $_SESSION['nom_theme'] =$t_name;
    $t_desc = $_POST["description"];    
    $result = $admin->addTheme($t_image, $t_name, $t_desc);

    if($result) {
        $theme_id = $admin->selectThemeId($t_name);  
        $tags = $_POST["tagsInput"];
        $sql = $admin->insertTags($theme_id, $tags);
        header("location: ../Pages/theme.php");
        exit();
    } else {
        $message = "Failed to add theme.";
    }
}   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Ajouter theme</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="flex">
        <?php
        include_once("../includes/navbar_admin.php");
        ?>
        <div class="form">
            
            <h2>Ajouter un theme </h2>
            <p class="erreur_message">
                <?php
                if (isset($message)) {
                    echo "" . $message . "";
                }
                ?>
            </p>
            
            <form action="" method="POST">
                <label>Photo du theme</label>
                <input type="file" name="imgt" required>
                <label>Nom de theme</label >
                <input type="text" name="nom_theme" required>
                <label>Description</label>
                <input type="text" name="description">
                <label>Saisissez vos tags (séparés par des virgules) :</label>
                 <input type="text" name="tagsInput" placeholder="tag1, tag2, tag3">
                <input type="submit" value="Ajouter" name="button">
            </form>
            <table>
                <tr id="items">
                    <th>Photo du produit</th>
                    <th>Nom theme</th>
                    <th>Description</th>
                    <th>Tags</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php
            $result = $admin->afficherTheme();
            foreach ($result as $row) {
                $resultt = $admin->afficherTags($row["theme_id"]);

                $tagNames = "";
                foreach ($resultt as $tag) {
                    $tagNames .= $tag["tag_name"] . ', ';
                }
                $tagNames = rtrim($tagNames, ', '); // Remove the trailing comma
                $_SESSION ['tags']=$tagNames;
                ?>
                <tr>
                    <div class="image">
                        <td><img src="../assets/images/<?= $row["theme_image"] ?>" alt=""></td>
                    </div>
                    <td><?= $row["theme_name"] ?> </td>
                    <td><?= $row["theme_desc"] ?> </td>
                    <td><?= $tagNames ?> </td>
                    <td><a class='table-link' href='../Pages/theme_ud.php?id_m=<?=$row['theme_id'] ?>'><img src='../assets/images/pen.png'></a></td>
                    <td><a class='table-link' href='../Pages/theme_ud.php?id_s=<?=$row['theme_id'] ?>'><img src='../assets/images/trash.png'></a></td>
                </tr>
            <?php
            }
            ?>

            </table>
        </div>
        
    </div>
</body> 

</html>
