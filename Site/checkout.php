<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $C_ID = $_POST['C_ID'];

        $sql1 = mysqli_query($con, "SELECT * from carts WHERE customer_id = '$C_ID'");

        $totalPrice = 0;

        while ($row1 = mysqli_fetch_array($sql1)) {

            $product_id = $row1['product_id'];
            $qty = $row1['qty'];

            $sql2 = mysqli_query($con, "SELECT * from store_items WHERE id = '$product_id'");
            $row2 = mysqli_fetch_array($sql2);

            $price = $row2['price'];

            $totalPrice += ($price * $qty);

        }
        


        $addOrderStmt = $con->prepare("INSERT INTO orders (client_id, total_price) VALUES (?, ?) ");
        $addOrderStmt->bind_param("id", $C_ID, $totalPrice);

        $status = 'Pending';
        $orderId = 0;

        if ($addOrderStmt->execute()) {

            $getOrderIdStmt = $con->prepare("SELECT id FROM orders WHERE status = ? AND client_id = ?");
            $getOrderIdStmt->bind_param("si", $status, $C_ID);
            $getOrderIdStmt->execute();
            $getOrderIdStmt->store_result();

            if ($getOrderIdStmt->num_rows > 0) {

                $getOrderIdStmt->bind_result($id);
                $getOrderIdStmt->fetch();

                $orderId = $id;

                $sql1 = mysqli_query($con, "SELECT * from carts WHERE customer_id = '$C_ID' ORDER BY id DESC");

                $totalPrice = 0;
                $isDone = false;

                while ($row1 = mysqli_fetch_array($sql1)) {

                    $product_id = $row1['product_id'];
                    $qty = $row1['qty'];

                    $sql2 = mysqli_query($con, "SELECT * from store_items WHERE id = '$product_id'");
                    $row2 = mysqli_fetch_array($sql2);

                    $price = $row2['price'];

                    $total_price = ($price * $qty);

                    $addOrderItemsStmt = $con->prepare("INSERT INTO order_items (order_id, product_id, qty, total_price) VALUES (?, ?, ?, ?) ");

                    $addOrderItemsStmt->bind_param("iiid", $orderId, $product_id, $qty, $total_price);

                    $addOrderItemsStmt->execute();

                }

                $isDone = true;
                $status = 'Done';

                if ($isDone) {

                    $updateOrderStatusStmt = $con->prepare("UPDATE orders set status = ? WHERE id = ? ");

                    $updateOrderStatusStmt->bind_param("si", $status, $orderId);

                    if ($updateOrderStatusStmt->execute()) {

                        echo "<script language='JavaScript'>
                        alert ('Added To Orders !');
                   </script>";

                        echo "<script language='JavaScript'>
                  document.location='./Orders.php';
                     </script>";
                    }

                }

            }

        }
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
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./Store.php">Store</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>



                <form action="./checkout.php?item_id=<?php echo $item_id ?>&qty=<?php echo $qty ?>" method="POST">

                <input type="hidden" name="C_ID" value="<?php echo $C_ID ?>">

                    <div class="row g-5">












                    <div class="col-md-6 col-lg-6 col-xl-6">









    <div class="form-item">
        <label class="form-label my-3">Payment Type<sup>*</sup></label>
        <select onchange="paymentType(event)" name="payment_type" id="payment_type"
         class="form-select" id="" required>


         <option value="E-Payment">E-Payment</option>
        <option value="Cash">Cash</option>





        </select>
    </div>


    <div id="e-payment">
    <div class="form-item">
        <label class="form-label my-3">Card Number </label>
        <input type="text" pattern="[0-9]{16}" class="form-control" >
    </div>

    <div class="form-item">
        <label class="form-label my-3">Card Holder Name </label>
        <input type="text"  class="form-control" >
    </div>

    <div class="form-item">
        <label class="form-label my-3">Expiry Date </label>
        <input type="date"  class="form-control" >
    </div>

    <div class="form-item">
        <label class="form-label my-3">CVV </label>
        <input type="text" pattern="[0-9]{3}" class="form-control" >
    </div>


    </div>

    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="Submit" name="Submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>


</div>







                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Item</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
$sql1 = mysqli_query($con, "SELECT * from carts WHERE customer_id = '$C_ID' ORDER BY id DESC");

$totalPrice = 0;

while ($row1 = mysqli_fetch_array($sql1)) {

    $cart_id = $row1['id'];
    $product_id = $row1['product_id'];
    $qty = $row1['qty'];

    $sql2 = mysqli_query($con, "SELECT * from store_items WHERE id = '$product_id'");
    $row2 = mysqli_fetch_array($sql2);

    $item_name = $row2['title'];
    $price = $row2['price'];
    $item_image = $row2['image'];

    $totalPrice += ($price * $qty)

    ?>

                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="../Admin_Dashboard/<?php echo $item_image ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?php echo $item_name ?></td>
                                            <td class="py-5"><?php echo $price ?> JDs</td>
                                            <td class="py-5"><?php echo $qty ?></td>
                                            <td class="py-5"><?php echo $price * $qty ?> JDs</td>
                                        </tr>

                                        <?php
}?>




                                    </tbody>

                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $totalPrice ?> JDs</td>
                                    </tfoot>

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


    <script>



const paymentType = (e) => {

    let paymentTypeVar = document.getElementById('payment_type').value
    console.log(paymentTypeVar);

        if(paymentTypeVar == 'E-Payment'){

            document.getElementById("e-payment").style.display = 'block'

        } else {

            document.getElementById("e-payment").style.display = 'none'


        }
}


    </script>
    </body>

</html>