<?php
session_start();

include "./Connect.php";

$type = $_GET['type'];

if (isset($_POST['Submit'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $Password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $type = $_POST['type'];

    if ($con_password == $Password) {

        if ($type == 'client') {

            $stmt = $con->prepare("UPDATE users SET password = ? WHERE email = ? AND phone = ? AND type = 'CLIENT'");

            $stmt->bind_param("sss", $Password, $email, $phone);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
                alert ('Password Updated Successfully !');
           </script>";

                echo '<script language="JavaScript">
                        document.location="./Client_Login.php";
                        </script>';

            }
        } else {

            $stmt = $con->prepare("UPDATE gyms SET password = ? WHERE email = ? AND phone = ?");

            $stmt->bind_param("sss", $Password, $email, $phone);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
                alert ('Password Updated Successfully !');
           </script>";

                echo '<script language="JavaScript">
                        document.location="./Manager_Login.php";
                        </script>';

            }

        }

    } else {

        echo "<script language='JavaScript'>
        alert ('Passwords Do Not Match !');
   </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Forget Password Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/Logo.jpg" rel="icon" />
    <link href="assets/img/Logo.jpg" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.php"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/Logo.jpg" alt="" width="50px"/>
                    <span class="d-none d-lg-block text-uppercase"
                      >GymHub</span
                    >
                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Login to Your Account
                      </h5>
                      <p class="text-center small">
                        Enter your Email & Password to login
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Forget_Password.php?type=<?php echo $type ?>" id="login-form" >

                    <input type="hidden" value="<?php echo $type ?>" name="type">

                      <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">

                          <input
                            type="text"
                            name="email"
                            class="form-control"
                            id="email"
                            required
                          />
                          <div class="invalid-feedback">
                            Please enter a valid Email adddress!
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="phone" class="form-label">Phone</label>
                        <div class="input-group has-validation">

                          <input
                            type="text"
                            name="phone"
                            class="form-control"
                            id="phone"
                            pattern="[0-9]{10}" title="Phone Number Must Be 10 Numbers"
                            required
                          />

                        </div>
                      </div>

                      <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group has-validation">

                          <input
                            type="password"
                            name="password"
                            class="form-control"
                            id="password"
                            required
                          />

                        </div>
                      </div>

                      <div class="col-12">
                        <label for="con_pass" class="form-label">Confirm Password</label>
                        <div class="input-group has-validation">

                          <input
                            type="password"
                            name="con_password"
                            class="form-control"
                            id="con_pass"
                            required
                          />

                        </div>
                      </div>




                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" name="Submit">
                          Update Password
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Don't have account?
                          <a href="./Client_Register.php">Create an account</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script>
      // let loginForm = $('#login-form')
      // let passwordMessageDiv = $('#password-Message')
      // let passwordInput = document.getElementById('yourPassword')
      // const re = new RegExp("^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$");


      // const onChange = (e) => {
      //   console.log(e.value);

      //   if(!re.test(e.value)){

      //     passwordMessageDiv.php("<p>Password Must be at least One Upper case, One Lower Case, Numbers & Symbols</p>")
      //   }
      // }
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
