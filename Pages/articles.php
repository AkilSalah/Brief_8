<?php
include_once("../Config/database.php");
session_start();

$user_id = null;
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $theme = null;
if (isset($_GET['id_theme'])) {
    $theme_id = $_GET['id_theme'];
    $_SESSION['id_theme'] = $theme_id;
    $theme = $_SESSION['id_theme'];
    
        if (isset($_POST["insert"])) {
            $title = $_POST["title"];
            $image = $_POST["image"];
            $description = $_POST["description"];
            $currentDateTime = date('Y-m-d H:i:s');

            if (isset($_POST["options"])) {
                $selectedTags = $_POST["options"];
                $json = json_encode($selectedTags);

                $stmt = $article->addArticle($title, $description, $image, $currentDateTime, $user_id, $theme_id, $json);

                if ($stmt) {
                    echo "Article inséré avec succès.";
                } else {
                    echo "Erreur lors de l'insertion de l'article.";
                }
            }
        }
    } else {
        echo "Erreur : id_theme non défini.";
    }
} else {
    echo "Erreur : utilisateur non connecté.";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     $("#simple-search").on("input", function () {
        //         var searchQuery = $(this).val();
        //         var themeId = getThemeIdFromURL();
        //         console.log("Theme ID from URL:", themeId);
        //         $.ajax({
        //             type: "GET",
        //             url: "./search.php",
        //             data: {
        //                 themeId: themeId,
        //                 query: searchQuery
        //             },
        //             success: function (response) {
        //                 console.log(response);

        //                 $("#search-results").html(response);
        //             },
        //             error: function (error) {
        //                 console.log("Ajax request failed:", error);
        //             }
        //         });
        //     });
        //     function getThemeIdFromURL() {
        //         var urlParams = new URLSearchParams(window.location.search);
        //         var themeId = urlParams.get('id_theme'); 
        //         return themeId;
        //     }
        // });
    </script>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .checkbox-container {
            height: 100px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class=" w-[91%] flex justify-center h-[20vh] items-center">
        <?php
            $tags = $article->selectTags($theme);
            foreach($tags as $tag){
                ?>
                <button id="filter-btn" type="button" value="<?= $tag["tag_name"] ?>" name="submitTag"
                    class=" btn bg-transparent-500 border border-gray-600 hover:bg-light-700 flex text-gray-500 font-bold py-2 px-4 rounded-full gap-5 ml-3">
                    <a>#
                        <?= $tag["tag_name"] ?>
                    </a>
                </button>
            <?php 

        } ?>
        <div class="ml-5"></div>
        <?php
         include("../Pages/buttonAdd.php");
        ?>
    </div>
    <div id="search-results"></div>
    <div id="articless" class="ALL min-h-[100vh] w-[90%] flex flex-wrap justify-evenly m-auto">
        <?php
        $articles = $article->selecyArticle($theme);
        foreach($articles as $article) :
                ?>
                <div
                    class=" w-[28%] h-[65vh] mb-[3rem] max-w-sm bg-white border  border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a class="w-[100%]" href="article.php?id=<?php echo $article['article_id'] ?>">
                        <img class="h-[38vh] w-[100%]  rounded-t-lg" src="../assets/images/<?= $article["article_image"] ?>"
                            alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <div class="h-[10vh]">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                <?php echo $article["article_title"]; ?>
                            </h5>

                        </div>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex text-gray-600 items-center space-x-1 rtl:space-x-reverse">
                                <p>author :
                                    <?php echo $article["nom"]; ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between  h-[20%]">
                          
                            <div class="flex items-center gap-[5px]">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" fill="gray"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                                <p class=" text-gray-600 text-[14px] ">
                                    <?php echo $article["created_at"]; ?>
                                </p>
                            </div>
                            <form action="article_info.php" method="get">
                            <input type="hidden" name="id_article" value="<?=$article['article_id']?>">
                            <button type="submit" class="bg-green-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                Découvrez plus
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

</body>

</html>