<?php
include_once("../Config/database.php");
session_start();
if (isset($_SESSION["user_id"])) {
    $id_user = $_SESSION["user_id"];
}
if(isset ($_GET['id'])){
    $id=$_GET['id'];
    $delete= $client->deletePanier($id);
    header ('location: panier.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Panier</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/maiin.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body{
            background: url(../assets/images/arrangement-jardin-potager-espace-copie.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>
<body>

    <section class="h-100 h-custom"  ">
    <div class="pt-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        </div>

                                        <div class="my-4">
                                            <?php
                                            $result = $client->selectPanier($id_user);
                                            foreach ($result as $result_info) :
                                            ?>
                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="../assets/images/<?= $result_info["image_url"] ?>" style='width: 100px; height: 100px;' class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted">Produit : </h6>
                                                        <h6 class="text-black mb-0"><?= $result_info["name_plant"] ?></h6>
                                                    </div>

                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h6 class="text-muted">Prix : </h6>
                                                        <h6 class="mb-0"><?= $result_info["price"] ?>Dh</h6>
                                                    </div>

                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <td><a class='table-link' href='panier.php?id=<?= $result_info['id'] ?>'><img src='../assets/images/trash.png' style='width: 25px; height: 25px;'></a></td>
                                                    </div>
                                                    

                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                        <hr class="my-4">
                                        <?php
                                        $prix = $client->priceSum($id_user);
                                        if (!empty($prix)) {
                                        ?>
                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">Total price</h5>
                                                <h5><?php echo $prix['somme']; ?> Dhs</h5>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        <form method="post" action="" >
                                            <?php
                                            
                                                $client->valider($id_user);
                                            
                                            ?>
                                            <input type="submit" value="Valider" name="valider" id="valider" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">
                                        </form>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
</body>

</html>
