<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>TRENDING BLOGS</title>
</head>

<body>

    <div class="container my-5">
        <h3 class="text-center mb-4">TRENDING BLOGS</h3>

        <section id="blogs" class="text-gray-800 my-4">
            <div class="row row-cols-3 g-4">
                <?php
                $themes = $blogs->selectTheme();
                foreach ($themes as $theme) :
                    $blogs->set_theme($theme['theme_id']);
                    $articleCounts = $blogs->NbArticle();
                    foreach ($articleCounts as $count) :
                ?>
                        <div class="col">
                            <div class="card h-50">
                                <img src="<?php echo "../assets/images/" . $theme['theme_image']; ?>" style="height: 100%;" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo "Nom : " . $theme['theme_name']; ?></h5>
                                    <p class="card-text mt-3 "><?php echo "Nombre des Articles : " . $count['nb_article']; ?></p>
                                    <p class="card-text"><?php echo "Description : " . $theme['theme_desc']; ?></p>
                                    <a href="articles.php?id_theme=<?php echo $theme["theme_id"]; ?>" class="btn btn-success">More</a>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endforeach;
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
