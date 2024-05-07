<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>GymHub</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

            <!-- Favicons -->
    <link href="./img/Logo.jpg" rel="icon" />
    <link href="./img/Logo.jpg" rel="apple-touch-icon" />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div>
                </div>
            </div>




            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">GymHub</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="Store.php" class="nav-item nav-link">Store</a>
                            <a href="Gyms.php" class="nav-item nav-link">Gyms</a>

                            <?php if ($C_ID) {?>

                                <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $name ?></a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="Account.php" class="dropdown-item">Account</a>
                                    <a href="Orders.php" class="dropdown-item">Orders</a>
                                    <a href="Subscriptions.php" class="dropdown-item">Subsciptions</a>
                                    <a href="Logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </div>


                            <?php } else {?>

                            <a href="../Client_Login.php" class="nav-item nav-link">Login</a>

                            <?php }?>





                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>

                    </div>
                </nav>
            </div>




        </div>
        <!-- Navbar End -->





        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">

                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Featurs Section Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">

                <?php
$sql1 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['id'];
    $category_name = $row1['name'];
    $category_image = $row1['image'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <a href="./Store.php?category_id=<?php echo $category_id ?>" class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <!-- <i class="fas fa-car-side fa-3x text-white"></i> -->
                                <img src="../Admin_Dashboard/<?php echo $category_image ?>" alt="">
                            </a>
                            <div class="featurs-content text-center">
                                <a href="./Store.php?category_id=<?php echo $category_id ?>"><?php echo $category_name ?></a>
                            </div>
                        </div>
                    </div>

                    <?php
}?>


                </div>
            </div>
        </div>
        <!-- Featurs Section End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Store Items</h1>
                        </div>

                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">

                                    <?php
$sql1 = mysqli_query($con, "SELECT * from store_items WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $item_id = $row1['id'];
    $category_id = $row1['category_id'];
    $title = $row1['title'];
    $item_image = $row1['image'];
    $quantity = $row1['quantity'];
    $active = $row1['active'];
    $price = $row1['price'];
    $description = $row1['description'];

    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $category_name = $row2['name'];

    ?>


                                        <a href="./Item.php?item_id=<?php echo $item_id?>" class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="../Admin_Dashboard/<?php echo $item_image ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $category_name ?></div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo $title ?></h4>
                                                    <p><?php echo $description ?></p>





                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $price ?> JDs</p>
                                                    </div>
                                                </div>
                                            </div>
</a>

                                        <?php
}?>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->




        <!-- Vesitable Shop Start-->
        <div class="container-fluid vesitable py-5">
            <div class="container py-5">
                <h1 class="mb-0">Gyms</h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">



                <?php
$sql1 = mysqli_query($con, "SELECT * from gyms WHERE active = 1 AND status = 'Accepted' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $gym_id = $row1['id'];
    $manager_id = $row1['manager_id'];
    $gym_image = $row1['image'];
    $gym_name = $row1['title'];
    $gym_email = $row1['email'];
    $gym_phone = $row1['phone'];
    $gym_city = $row1['city'];
    $status = $row1['status'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$manager_id'");
    $row2 = mysqli_fetch_array($sql2);

    $manager_name = $row2['name'];

    ?>

                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="../Gym_Dashboard/<?php echo $gym_image ?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $manager_name ?></div>
                        <div class="p-4 rounded-bottom">
                            <h4><?php echo $gym_name ?></h4>
                            <p><?php echo $gym_city ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <a href="./Gym.php?gym_id=<?php echo $gym_id ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> View Gym</a>
                            </div>
                        </div>
                    </div>

                    <?php
}?>


                </div>
            </div>
        </div>
        <!-- Vesitable Shop End -->





        <!-- Bestsaler Product Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                    <h1 class="display-4">Gym Offers</h1>
                    <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                </div>
                <div class="row g-4">


                <?php
$sql1 = mysqli_query($con, "SELECT * from gym_offers WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $offer_id = $row1['id'];
    $offer_name = $row1['name'];
    $offer_price = $row1['price'];
    $offer_duration = $row1['duration'];
    $created_at = $row1['created_at'];
    $active = $row1['active'];
    $gym_id = $row1['gym_id'];

    $sql2 = mysqli_query($con, "SELECT * from gyms WHERE id = '$gym_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $gym_Offer_name = $row2['title'];
    $total_rate = $row2['total_rate'];
    $gym_offer_image = $row2['image'];

    ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="../Gym_Dashboard/<?php echo $gym_offer_image ?>" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h5"><?php echo $offer_name ?> By <?php echo $gym_Offer_name ?></a>
                                    <div class="d-flex my-3">

                                    <?php for ($i = 1; $i <= $total_rate; $i++) {?>


                                        <i class="fas fa-star text-primary"></i>

                                        <?php }?>




                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3"><?php echo $offer_price ?> JDs</h4>
                                    <a href="./Offer.php?offer_id=<?php echo $offer_id ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> View Offer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
}?>


                </div>
            </div>
        </div>
        <!-- Bestsaler Product End -->




        <!-- Footer Start -->
            <?php include './Footer.php';?>
        <!-- Footer End -->





        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>