<?php
require_once("../Config/database.php");
session_start();

$user_id = null;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];   
}
if (isset($_GET["id_pro"])) {
    $id_pro = $_GET['id_pro']; 
    $client->setId_produit($id_pro);
    $client->setId_user($user_id);
    $req = $client->addPanier();

    if ($req) {
        header("location: client.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout au panier.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='maiin.css'>
    <script src='main.js'></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
    .navbar-nav-right {
        margin-left: auto;
    }
    .w_image{
        width: 200px;
        height: 200px;
    }
    .nav{
        height: 60px;
    }
</style> 
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/images/logo-removebg-preview.png" alt="" style="width: 50px;">
                <span class="fw-bold text-black ">PLANTE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav " style="margin-left: 40%;" >
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categories">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categories">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blogs">Blogs</a>
                    </li>
                </ul>             
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item ">
                        <a class="nav-link d-flex align-items-center" href="panier.php">
                            <i id="shop" class="fas fa-shopping-cart fa-lg me-2"></i>
                            <?php
                            $client->setId_user($user_id);
                            $nb = $client->panierNB();
                            echo $nb;
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5" >
        <div class="row">
            <div class="col-7 d-flex m-auto">
                <div class="mx-5 ">
                    <h1 class="text-black">THE WORLD OF PLANTS</h1>
                    <p>Les plantes, en plus d'apporter une touche de verdure à notre environnement,
                        jouent un rôle crucial dans l'équilibre écologique de la planète.
                        Elles contribuent à purifier l'air, offrent un habitat à la vie sauvage
                        et ajoutent une beauté naturelle à notre quotidien.</p>
                    <button class="btn btn-success w-25">More</button>
                </div>
            </div>
            <div class="col-5">
                <img src="../assets/images/6.jpg" class="img-fluid mt-5" alt="">
            </div>
        </div>
    </div>
    </div>
    </section>
    <section class="sec2 mt-5 " id="about" >
        <div class="container">
            <h3 class="text-center mt-3">Bienvenue dans votre espace dédié à l'amour des plantes sur Plants !   </h3>
            <div class="row  d-flex mt-5 ">
                <div class="col-xl-6 col-lg-6  col-md-9 col-sm-10 ">
                    <img src="../assets/images/petits-cactus-fond-mur-blanc.jpg" alt="" class="w-100">
                </div>

                <div class="text_btn col-xl-5 col-lg-5  col-sm-10 pt-5 d-flex flex-column text-center">
                    <p class="txt">
                        Bienvenue sur Plants - votre destination en ligne dédiée à la fascination des plantes. Chez nous, la passion pour la verdure rencontre l'expertise, offrant un espace où les amoureux de la nature peuvent s'instruire, s'inspirer et se connecter. Explorez nos ressources soigneusement élaborées, des guides pratiques aux articles captivants, et rejoignez une communauté florissante de personnes partageant la même passion. Chez Plants, notre mission est de cultiver la curiosité botanique et de faire fleurir votre amour pour le monde végétal. Bienvenue dans notre jardin virtuel, où la découverte et l'épanouissement botanique sont au cœur de tout ce que nous faisons.
                    </p>
                    <button class="btn btn-success  mt-5 translate-middle-x">More</button>

                </div>
            </div>
    </section>
   
    <section id="product">
        <h1 class="Product text-center mt-5"> Nos Produits</h1>
        <nav class="navbar ">
            <div class="container justify-content-around mt-5 ">
                <div>
                     <a class="btn fw-bold btn-outline-dark" href="client.php?voir_tout ">Tout </a>
                     <?php 
                        $cats = $client->selectCategory();
                        foreach ($cats as $cat) {
                            $categoryId = $cat['id_cat'];
                            $categoryName = $cat['name_cat'];
                            $url = "?id_categorie=$categoryId";
                        ?>
                            <a class="btn fw-bold btn-outline-success" href="<?php echo $url; ?>"><?php echo $categoryName; ?></a>
                        <?php
                        }
                        ?>
                </div>
                <form class="d-flex" action="" method="GET">
                    <input class="form-control me-2" id="searchInput" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" id="searchButton">Search</button>
                </form>
            </div>
        </nav>
        <?php
            $products = $client->selectProduct();

            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                if (!empty($search)) {
                    $products = $client->searchProduct($search);
                }
            }

            if (isset($_GET['id_categorie'])) {
                $categoryId = $_GET['id_categorie'];
                if (!empty($categoryId)) {
                    $client->setId_category($categoryId);
                    $products = $client->filtreCategory();
                }
            }
            ?>
    <div class="text-center container py-5">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card">
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light">
                            <img src="../assets/images/<?= $product["image_url"] ?>" class="w_image">
                            <a href="#!">
                                <div class="mask"></div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="" class="text-reset text-decoration-none">
                                <h5 class="card-title mb-3"><?= $product["name_plant"] ?></h5>
                            </a>
                            <a href="" class="text-reset text-decoration-none">
                            <p>Catégorie : <?= $product["name_cat"] ?></p>
                            </a>
                            <h6 class="mb-3">Prix :<?= $product["price"] ?> DH</h6>
                            <a class='table-link btn btn-success' href='client.php?id_pro=<?= $product['id_plant'] ?>'>Commander</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </section>
    
    <section>
        <?php 
        include_once('../Pages/blogs.php');
        ?>
    </section>
    




    <footer class="text-center text-white mt-5" ">
      <div class="container p-4">
        <section class="">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="ratio ratio-16x9">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/A6rRn9jN-bw?si=_MTBoywrEpkH5gPi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </section>

      </div>

      <div class="text-center p-3 bg-success" ">
        © 2023 Copyright:
        <a class="text-white" href="https://intranet.youcode.ma/profile">CodeX.com</a>
      </div>

    </footer>

</body>
</html>