<?php
session_start();

include "../Connect.php";

$M_ID = $_SESSION['M_Log'];

if (!$M_ID) {

    echo '<script language="JavaScript">
     document.location="../Manager_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from gyms where manager_id='$M_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $gym_id = $row1['id'];
    $name = $row1['title'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $gym_id = $_POST['gym_id'];
        $start_date = $_POST['start_date'];
        $contract_type = $_POST['contract_type'];

        $stmt = $con->prepare("SELECT end_date FROM gyms_contracts WHERE gym_id = ?");
        $stmt->bind_param("i", $gym_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

            $stmt->bind_result($end_date);
            $stmt->fetch();

            $end_date = new DateTime($end_date);

            $today = new DateTime();

            if ($end_date < $today) {

                if ($contract_type == 1) {

                    $end_date = date('d-m-Y', strtotime($start_date . ' +90 days'));
                    $contract_type = "3 Months Open Contract (First Time Only) (For Free)";

                } else if ($contract_type == 2) {

                    $end_date = date('d-m-Y', strtotime($start_date . ' +180 days'));
                    $contract_type = "6 Months Contract (300 JOD)";

                } else if ($contract_type == 3) {

                    $end_date = date('d-m-Y', strtotime($start_date . ' +360 days'));
                    $contract_type = "12 Months COntract (600 JOD)";

                }

                $stmt = $con->prepare("INSERT INTO gyms_contracts (gym_id, contract_type, start_date, end_date) VALUES (?, ?, ?, ?) ");

                $stmt->bind_param("isss", $gym_id, $contract_type, $start_date, $end_date);

                if ($stmt->execute()) {

                    echo "<script language='JavaScript'>
                alert ('New Contract Have Been Added !');
           </script>";

                    echo "<script language='JavaScript'>
          document.location='./Contracts.php';
             </script>";

                }

            } else {

                echo "<script language='JavaScript'>
                alert ('Contract is still active. !');
           </script>";
            }

        } else {

            if ($contract_type == 1) {

                $end_date = date('d-m-Y', strtotime($start_date . ' +90 days'));
                $contract_type = "3 Months Open Contract (First Time Only) (For Free)";

            } else if ($contract_type == 2) {

                $end_date = date('d-m-Y', strtotime($start_date . ' +180 days'));
                $contract_type = "6 Months Contract (300 JOD)";

            } else if ($contract_type == 3) {

                $end_date = date('d-m-Y', strtotime($start_date . ' +360 days'));
                $contract_type = "12 Months COntract (600 JOD)";

            }

            $stmt = $con->prepare("INSERT INTO gyms_contracts (gym_id, contract_type, start_date, end_date) VALUES (?, ?, ?, ?) ");

            $stmt->bind_param("isss", $gym_id, $contract_type, $start_date, $end_date);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
            alert ('New Contract Have Been Added !');
       </script>";

                echo "<script language='JavaScript'>
      document.location='./Contracts.php';
         </script>";

            }
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Contracts - Gym Hub</title>
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
        <h1>Contracts</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Contracts</li>
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
            Add New Contract
          </button>
        </div>




        <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Contract Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Contracts.php" enctype="multipart/form-data">

                <input type="hidden" name="gym_id" value="<?php echo $gym_id ?>" class="form-control" />


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      > Start Date</label
                    >
                    <div class="col-sm-8">
                      <input type="date" name="start_date" min="<?php echo date('Y-m-d') ?>" class="form-control" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="contract_type" class="col-sm-4 col-form-label"
                      > Contract Type</label
                    >
                    <div class="col-sm-8">
                      <select name="contract_type" class="form-select" id="contract_type" required>
                            <option value="1">3 Months Open Contract (First Time Only) (For Free)</option>
                            <option value="2">6 Months Contract (300 JOD)</option>
                            <option value="3">12 Months COntract (600 JOD)</option>
                        </select>


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
                      <th scope="col">Contract Type</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Days Left</th>
                      <th scope="col">Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
$sql1 = mysqli_query($con, "SELECT * from gyms_contracts WHERE gym_id = '$gym_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $contract_id = $row1['id'];
    $contract_type = $row1['contract_type'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $created_at = $row1['created_at'];

    $current_date = new DateTime();
    $end_date_time = new DateTime($end_date);
    $interval = $current_date->diff($end_date_time);
    $days_left = $interval->days;

    ?>
                    <tr>
                      <th scope="row"><?php echo $contract_id ?></th>
                      <th scope="row"><?php echo $contract_type ?></th>
                      <td><?php echo $start_date ?></td>
                      <td><?php echo $end_date ?></td>
                      <td><?php

    if ($end_date_time < $current_date) {

        echo "Days Passed";

    } else {

        echo "$days_left Days";
    }

    ?></td>
                      <td><?php echo $created_at ?></td>

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
     document.querySelector('#sidebar-nav .nav-item:nth-child(7) .nav-link').classList.remove('collapsed')
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
