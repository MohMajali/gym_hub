<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];
$offer_id = $_GET['offer_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

$sql2 = mysqli_query($con, "select * from gym_offers where id='$offer_id'");
$row2 = mysqli_fetch_array($sql2);

$offer_name = $row2['name'];
$offer_price = $row2['price'];
$offer_duration = $row2['duration'];
$description = $row2['description'];
$created_at = $row2['created_at'];
$active = $row2['active'];
$gym_id = $row2['gym_id'];

$sql3 = mysqli_query($con, "SELECT * from gyms WHERE id = '$gym_id'");
$row3 = mysqli_fetch_array($sql3);

$gym_Offer_name = $row3['title'];
$gym_phone = $row3['phone'];
$gym_offer_image = $row3['image'];

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
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="Store.php" class="nav-item nav-link ">Store</a>
                            <a href="Gyms.php" class="nav-item nav-link active">Gyms</a>

                            <?php if ($C_ID) {?>

                                <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $name ?></a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="Account.php" class="dropdown-item">Account</a>
                                    <a href="Cart.php" class="dropdown-item">Cart</a>
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





        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6"><?php echo $offer_name ?> Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./Gyms.php">Gyms</a></li>
                <li class="breadcrumb-item active text-white"><?php echo $offer_name ?> Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="../Gym_Dashboard/<?php echo $gym_offer_image ?>" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?php echo $offer_name ?></h4>
                                <p class="mb-3">Offer Price: <?php echo $offer_price ?> JDs</p>
                                <p class="mb-3">Offer Duration: <?php echo $offer_duration ?></p>
                                <p class="mb-3">Gym Phone: <?php echo $gym_phone ?></p>
                                <p><?php echo $description ?></p>

                                <div class="input-group quantity mb-5" style="width: 100px;">

                                <!-- <input type="hidden" name="item_id" id="item_id_hidden" value="<?php echo $item_id ?>"> -->




                            </div>



                                <a href="./Gym_Subscription.php?gym_id=<?php echo $gym_id ?>&offer_id=<?php echo $offer_id ?>" id="buy_item-<?php echo $item_id ?>" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class=" me-2 text-primary"></i> Get Offer</a>


                            </div>




                        </div>
                    </div>







                </div>
                <h1 class="fw-bold mb-0"><?php echo $gym_name ?> Offers</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">





                    <?php

$sql1 = mysqli_query($con, "SELECT * from gym_offers WHERE gym_id = '$gym_id' AND active = 1 ORDER BY id DESC");

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
                        <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                                <img src="../Gym_Dashboard/<?php echo $gym_offer_image ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $gym_Offer_name ?></div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?php echo $offer_name ?></h4>
                                <p><?php echo $offer_duration ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold"><?php echo $offer_price ?> JDs</p>
                                    <a href="./Offer.php?offer_id=<?php echo $offer_id ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class=" me-2 text-primary"></i> View Offer</a>
                                </div>
                            </div>
                        </div>

                        <?php
}?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->


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
    <script src="js/main.js">


    </script>


<script>

const navigate = (e) => {
            const itemId = e.target.id.split('-')[1]
            const qty = document.getElementById('item_qty').value;

            document.location = `./checkout.php?item_id=${itemId}&qty=${qty}`;
        }


</script>
    </body>

</html>