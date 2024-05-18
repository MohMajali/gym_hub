<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];

$rate = $_POST['rate'];
$offers = $_POST['offers'];


$response = array();

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

if (isset($_POST['filter'])) {

    if (isset($_POST['rate'])) {

        $rate = $_POST['rate'];

        $rateSql = mysqli_query($con, "SELECT * from gyms WHERE total_rate >= '$rate' AND active = 1 AND status = 'Accepted' ");

        while ($rateRow1 = mysqli_fetch_array($rateSql)) {

            $manager_id = $rateRow1['manager_id'];

            $rateSql2 = mysqli_query($con, "SELECT * from users WHERE id = '$manager_id'");
            $rateRow2 = mysqli_fetch_array($rateSql2);
    
            $manager_name = $rateRow2['name'];
            

            $gym = [
                "gym_id" => $rateRow1['id'],
                "manager_id" => $rateRow1['manager_id'],
                "gym_image" => $rateRow1['image'],
                "gym_name" => $rateRow1['title'],
                "gym_phone" => $rateRow1['phone'],
                "manager_name" => $rateRow2['name'],
            ];

            $response[] = $gym;
        }

    } else if (isset($_POST['offers'])) {

        $offers = $_POST['offers'];

        if ($offers == 1) {

            $offersSql = mysqli_query($con, "SELECT gym_offers.gym_id,
            gyms.id, gyms.manager_id, gyms.title AS gym_name, gyms.phone AS gym_phone, gyms.image AS gym_image,
            users.name AS manager_name
            from gym_offers
            INNER JOIN gyms ON gyms.id = gym_offers.gym_id
            INNER JOIN users ON users.id = gyms.manager_id
            WHERE gym_offers.active = 1 AND gyms.active = 1 AND gyms.status = 'Accepted'
            ORDER BY gym_offers.price ASC");

        } else if ($offers == 2) {

            $offersSql = mysqli_query($con, "SELECT gym_offers.gym_id,
            gyms.id, gyms.manager_id, gyms.title AS gym_name, gyms.phone AS gym_phone, gyms.image AS gym_image,
            users.name AS manager_name
            from gym_offers
            INNER JOIN gyms ON gyms.id = gym_offers.gym_id
            INNER JOIN users ON users.id = gyms.manager_id
            WHERE gym_offers.active = 1 AND gyms.active = 1 AND gyms.status = 'Accepted'
            ORDER BY gym_offers.price DESC");

        }

        while ($offersRow1 = mysqli_fetch_array($offersSql)) {

            $response[] = $offersRow1;
        }

    }

} else {

    $normalSql = mysqli_query($con, "SELECT * from gyms WHERE active = 1 AND status = 'Accepted' ORDER BY id DESC");

    while ($noramlRow = mysqli_fetch_array($normalSql)) {

        $gym_id = $noramlRow['id'];
        $manager_id = $noramlRow['manager_id'];
        $gym_image = $noramlRow['image'];
        $gym_name = $noramlRow['title'];
        $gym_email = $noramlRow['email'];
        $gym_phone = $noramlRow['phone'];
        $gym_city = $noramlRow['city'];
        $status = $noramlRow['status'];
        $active = $noramlRow['active'];
        $created_at = $noramlRow['created_at'];

        $normalSql2 = mysqli_query($con, "SELECT * from users WHERE id = '$manager_id'");
        $normalRow2 = mysqli_fetch_array($normalSql2);

        $manager_name = $normalRow2['name'];

        $gym = [
            "gym_id" => $noramlRow['id'],
            "manager_id" => $noramlRow['manager_id'],
            "gym_image" => $noramlRow['image'],
            "gym_name" => $noramlRow['title'],
            "gym_phone" => $noramlRow['phone'],
            "manager_name" => $normalRow2['name'],
        ];

        $response[] = $gym;

    }

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
            <h1 class="text-center text-white display-6">Gyms</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./Gyms.php">Gyms</a></li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Gyms Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">



            <!-- FORM -->


        <div class="row mb-3">



        <form action="./Gyms.php" method="POST" class="row">


        <div class="col-md-4">


        <select class="form-select" aria-label="Default select example" name="rate">
        <option disabled selected>Select Rate</option>

        <option value="1" <?php echo $rate == 1 ? "selected" : ""?>>1</option>
        <option value="2" <?php echo $rate == 2 ? "selected" : ""?>>2</option>
        <option value="3" <?php echo $rate == 3 ? "selected" : ""?>>3</option>
        <option value="4" <?php echo $rate == 4 ? "selected" : ""?>>4</option>
        <option value="5" <?php echo $rate == 5 ? "selected" : ""?>>5</option>
        </select>

        </div>




        <div class="col-md-4">


        <select class="form-select" aria-label="Default select example" name="offers">

        <option value="1" <?php echo $offers == 1 ? "selected" : ""?>>Offers High > Low</option>
        <option value="2" <?php echo $offers == 2 ? "selected" : ""?>>Offers Low > Hight</option>
        </select>
        </div>




        <div class="text-center col-md-4">
                      <button type="submit" name="filter" class="btn btn-primary">
                        Filter
                      </button>
                    </div>
        </form>
        </div>






            <!-- FORM -->












                <h1 class="mb-4">Gyms</h1>
                <div class="row g-4">
                    <div class="col-lg-12">

                        <div class="row g-4">


                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">



                                    <?php foreach ($response as $row) {?>

                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="../Gym_Dashboard/<?php echo $row['gym_image'] ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['manager_name'] ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['gym_name'] ?></h4>
                                                <p><?php echo $row['gym_phone'] ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <a href="./Gym.php?gym_id=<?php echo $row['gym_id'] ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class=" me-2 text-primary"></i> View Gym</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }?>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gyms Shop End-->


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