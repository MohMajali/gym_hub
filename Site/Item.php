<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];
$item_id = $_GET['item_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

$sql2 = mysqli_query($con, "select * from store_items where id='$item_id'");
$row2 = mysqli_fetch_array($sql2);

$category_id = $row2['category_id'];
$title = $row2['title'];
$item_image = $row2['image'];
$quantity = $row2['quantity'];
$active = $row2['active'];
$price = $row2['price'];
$description = $row2['description'];

$sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
$row3 = mysqli_fetch_array($sql3);

$category_name = $row3['name'];

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
                            <a href="Store.php" class="nav-item nav-link active">Store</a>
                            <a href="Gyms.php" class="nav-item nav-link">Gyms</a>

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
            <h1 class="text-center text-white display-6"><?php echo $title ?> Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./Store.php">Store</a></li>
                <li class="breadcrumb-item active text-white"><?php echo $title ?> Detail</li>
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
                                        <img src="../Admin_Dashboard/<?php echo $item_image ?>" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?php echo $title ?></h4>
                                <p class="mb-3">Category: <?php echo $category_name ?></p>
                                <h5 class="fw-bold mb-3"><?php echo $price ?> JDs</h5>
                                <!-- <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div> -->
                                <p class="mb-4"><?php echo $description ?></p>
                                <div class="input-group quantity mb-5" style="width: 100px;">


                                <input type="hidden" value="<?php echo $C_ID ?>" name="C_ID" id="C_ID">
                                <input type="hidden" value="<?php echo $item_id ?>" name="item_id" id="item_id">



                                <?php if ($quantity > 0) {?>

                                    <select name="qty" id="item_qty">
                                        <?php for ($i = 1; $i <= $quantity; $i++) {?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php }?>
                                    </select>
                                    <?php } else {?>

                                        <h5>Out Of Stock</h5>
                                    <?php }?>
                            </div>





                            <?php if ($C_ID) {?>


                                <?php if ($quantity > 0) {?>


                                <button onclick="navigate(event)" id="buy_item-<?php echo $item_id ?>" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class=" me-2 text-primary"></i> Add To Cart</button>

                                
                                <?php }?>





                                <?php } else {?>

                                    <a href="../Client_Login.php" id="buy_item" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class=" me-2 text-primary"></i> Login First</a>


                                <?php }?>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p><?php echo $description ?></p>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>







                </div>
                <h1 class="fw-bold mb-0">Related Items</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">





                    <?php

$sql1 = mysqli_query($con, "SELECT * from store_items WHERE category_id = '$category_id' ORDER BY id DESC");

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
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="../Admin_Dashboard/<?php echo $item_image ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $category_name ?></div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?php echo $title ?></h4>
                                <p><?php echo $description ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold"><?php

    if ($quantity > 0) {

        echo $price;
    } else {
        echo "Out Of Stock";
    }

    ?></p>
                                    <a href="./Item.php?item_id=<?php echo $item_id ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class=" me-2 text-primary"></i> View Item</a>
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
            // const itemId = e.target.id.split('-')[1]
            // const qty = document.getElementById('item_qty').value;

            // document.location = `./checkout.php?item_id=${itemId}&qty=${qty}`;



            const qty = document.getElementById('item_qty').value
            const clientId = document.getElementById('C_ID').value
            const itemId = document.getElementById('item_id').value

            $.ajax({
                type: "POST",
                url: "./AddToCart.php",
                data: {
                    qty: qty,
                    customer_id: clientId,
                    product_id: itemId
                },
                success: function(response) {

                    if(!JSON.parse(response).error){

                        alert ('Added To Cart !');

                    }

                },
                error: function(error) {
                    console.error('Error updating quantity:', error);
                }
            });





        }


</script>
    </body>

</html>