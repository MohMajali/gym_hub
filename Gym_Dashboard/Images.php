<?php
session_start();

include "../Connect.php";

$G_ID = $_SESSION['G_Log'];

if (!$G_ID) {

    echo '<script language="JavaScript">
     document.location="../Gym_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from gyms where id='$G_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['title'];
    $email = $row1['email'];
    $phone = $row1['phone'];
    $image = $row1['image'];

    if (isset($_POST['Submit'])) {

        $G_ID = $_POST['G_ID'];
        $image = $_FILES["file"]["name"];

        $image = 'Gyms_Images/' . $image;

        $stmt = $con->prepare("INSERT INTO gym_images (gym_id, image) VALUES (?, ?) ");

        $stmt->bind_param("is", $G_ID, $image);

        if ($stmt->execute()) {

            move_uploaded_file($_FILES["file"]["tmp_name"], "./Gyms_Images/" . $_FILES["file"]["name"]);

            echo "<script language='JavaScript'>
                alert ('Add New Image For Gym !');
           </script>";

            echo "<script language='JavaScript'>
          document.location='./Images.php';
             </script>";

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Images - GymHub</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/Logo.jpg" rel="icon" />
    <link href="../assets/img/Logo.jpg" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="../assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="../assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <img src="../assets/img/Logo.jpg" alt="" />

        </a>
      </div>
      <!-- End Logo -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
                src="https://www.computerhope.com/jargon/g/guest-user.png"
                alt="Profile"
                class="rounded-circle"
              />
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name ?></span> </a
            >

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $name ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="./Logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php require './Aside-Nav/Aside.php'?>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Images</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Images</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">
      <div class="mb-3">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verticalycentered"
          >
            Add New Image
          </button>
        </div>

        <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Image Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Images.php" enctype="multipart/form-data">

                <input type="hidden" name="G_ID" value="<?php echo $G_ID ?>" class="form-control" />


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      > Image</label
                    >
                    <div class="col-sm-8">
                      <input type="file" name="file" class="form-control" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="Submit" class="btn btn-primary">
                        Submit Form
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                              <!-- Table with stripped rows -->
                              <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Image</th>
                      <th scope="col">Category</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sql1 = mysqli_query($con, "SELECT * from gym_images WHERE gym_id = '$G_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $image_id = $row1['id'];
    $image = $row1['image'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $image_id ?></th>
                      <td><img src="<?php echo $image ?>" alt="" width="150px" height="150px"></td>
                      <td>
                        <a href="./DeleteImage.php?image_id=<?php echo $image_id ?>" class="btn btn-danger">Delete</a>
                      </td>

                    </tr>
<?php
}?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>GymHub</span></strong
        >. All Rights Reserved
      </div>
    </footer>
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <script>
    window.addEventListener('DOMContentLoaded', (event) => {
     document.querySelector('#sidebar-nav .nav-item:nth-child(3) .nav-link').classList.remove('collapsed')
   });
</script>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
