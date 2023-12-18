<?php 
include_once("../Config/database.php");
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.9/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

</head>

<body>
<h3 class="font-serif text-3xl mx-auto text-center mb-10">TRENDING BLOGS</h3>
<section id="blogs" class="text-gray-800 h-[100vh]  my-8">
    <div class="w-[85%] m-auto ">
        <div class="gap-x-12 gap-y-8  flex justify-center  items-center">
            <?php
            $themes = $blogs->selectTheme();
            foreach($themes as $theme):
                    ?>
                    <article
                        class="flex flex-col  bg-gray-50 h-[8rem]  gap-[20px]  swiper-slide w-[40%] shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="flex flex-col flex-1">
                            <div class="flex flex-wrap  justify-between pt-3 space-x-2 text-xxl-end text-gray-600">
                                <span>
                                    <?php echo $theme["theme_name"]; ?>
                                </span>
                                <?php
                                $articleCounts = $blogs->NbArticle($theme['theme_id']);
                                foreach ($articleCounts as $count) {
                                    echo $count['nb_article']   ."Article" ; 
                                }
                                ?>

                            </div>
                            <a rel="noopener noreferrer" href="#"
                                aria-label="Te nulla oportere reprimique his dolorum">
                                <?php echo "<img class='h-[50vh] w-[100%]' src='data:image/jpg;charset=utf8;base64," . base64_encode(file_get_contents("../assets/images/" . $theme['theme_image'])) . "'>"; ?>
                            </a>
                            <span>
                                <?php echo $theme["theme_desc"]; ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-center py-4">
                            <a href="articles.php?id_theme=<?=$theme["theme_id"] ?>">
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                    More
                                </button>
                            </a>
                        </div>
                    </article>
                <?php endforeach;
            ?>
        </div>
    </div>
</section>

</body>

</html>