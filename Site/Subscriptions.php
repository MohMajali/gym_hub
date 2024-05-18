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



        <style>

.star {
  color: #ccc; /* Default color for stars */
}

.star:hover ~ .star {
  color: #fad00e; /* Change color of stars when hovered */
}

.star:hover {
  color: #fad00e; /* Change color of hovered star */
}


    </style>
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
                            <a href="Gyms.php" class="nav-item nav-link">Gyms</a>

                            <?php if ($C_ID) {?>

                                <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><?php echo $name ?></a>
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
            <h1 class="text-center text-white display-6">Subsciptions</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./Gyms.php">Gyms</a></li>
                <li class="breadcrumb-item active text-white">Subsciptions</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4"> Subsciptions</h1>
                <form action="#">


                    <div class="row g-5">

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Subscription #</th>
                                            <th scope="col">Gym Image</th>
                                            <th scope="col">Gym</th>
                                            <th scope="col">Offer</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Stauts</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                    <?php
$sql1 = mysqli_query($con, "SELECT * from clients_subscriptions WHERE client_id = '$C_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $subcription_id = $row1['id'];
    $gym_id = $row1['gym_id'];
    $offer_id = $row1['offer_id'];
    $payment_type = $row1['payment_type'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $created_at = $row1['created_at'];
    $status = $row1['status'];

    $sql2 = mysqli_query($con, "SELECT * from gyms WHERE id = '$gym_id'");
    $row2 = mysqli_fetch_array($sql2);

    $gym_name = $row2['title'];
    $gym_image = $row2['image'];

    $sql3 = mysqli_query($con, "SELECT * from gym_offers WHERE id = '$offer_id'");
    $row3 = mysqli_fetch_array($sql3);

    $offer_name = $row3['name'];

    $sql4 = mysqli_query($con, "SELECT * from gym_client_ratings WHERE gym_id = '$gym_id' AND client_id = '$C_ID'");
    $row4 = mysqli_fetch_array($sql4);

    $rate_id = $row4['id'];

    ?>
                                        <tr>
                                        <td class="py-5"><?php echo $subcription_id ?></td>

                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="../Gym_Dashboard/<?php echo $gym_image ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?php echo $gym_name ?></td>
                                            <td class="py-5"><?php echo $offer_name ?? "NON" ?></td>
                                            <td class="py-5"><?php echo $start_date ?> - <?php echo $end_date ?></td>
                                            <td class="py-5"><?php echo $status ?></td>
                                            <td class="py-5"><?php echo $created_at ?></td>
                                            <td class="py-5 text-center mr-4" dir="rtl">



<?php if (!$rate_id) {?>


<a href="Rate_Gym.php?Rate=5&gym_id=<?php echo $gym_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="5" class="fa fa-star"></i></a>

<a href="Rate_Gym.php?Rate=4&gym_id=<?php echo $gym_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="4" class="fa fa-star"></i></a>

<a href="Rate_Gym.php?Rate=3&gym_id=<?php echo $gym_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="3" class="fa fa-star"></i></a>

<a href="Rate_Gym.php?Rate=2&gym_id=<?php echo $gym_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="2" class="fa fa-star"></i></a>

<a href="Rate_Gym.php?Rate=1&gym_id=<?php echo $gym_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="1" class="fa fa-star"></i></a>

<?php }?>



                                            </td>
                                            <td class="py-5">

<?php if ($status != 'Cancel') {?>
                                            <a href="JavaScript:if(confirm('Are You Sure To Cancel This Subscription ?')==true)
{window.location='CancelSubscription.php?subcription_id=<?php echo $subcription_id; ?>&status=Canceled';}" class="btn btn-danger">Cancel</a>
<?php }?>

                                            </td>
                                        </tr>



                                        <?php
}?>



                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->


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