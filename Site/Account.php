<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
    $password = $row1['password'];
    $phone = $row1['phone'];

    if (isset($_POST['Submit'])) {
        $C_ID = $_POST['C_ID'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $stmt = $con->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ? WHERE id = ? ");

        $stmt->bind_param("ssssi", $name, $email, $phone, $password, $C_ID);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
            alert ('Account Updated Success !');
       </script>";

            echo "<script language='JavaScript'>
      document.location='./Account.php';
         </script>";

        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>FrameMe</title>

        <!-- Favicons -->
        <link href="../assets/img/logo_1.png" rel="icon" />
    <link href="../assets/img/logo_1.png" rel="apple-touch-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Mukta+Mahee:200,300,400|Playfair+Display:400,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <header class="site-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4 site-logo" data-aos="fade"><a href="index.php"><em>FrameMe</em></a></div>
          <div class="col-8">


            <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6">
                    <ul class="list-unstyled menu">
                        <li><a href="index.php">Home</a></li>
                        <li ><a href="Photographers.php">Photographers</a></li>
                        <li><a href="Categories.php">Categories</a></li>
                        <li><a href="about.php">About</a></li>
                        <?php if ($C_ID) {?>
                        <li><a href="Reservations.php">Reservations</a></li>
                        <li class="active"><a href="Account.php">Account</a></li>
                        <?php } else {?>
                          <li><a href="../Login.php">Login</a></li>

                          <?php }?>
                        <li><a href="contact.php">Contact</a></li>

                        <?php if ($C_ID) {?>
                        <li><a href="./logout.php">Logout</a></li>
                        
                        <?php }?>
                      </ul>
                    </div>
                    <div class="col-md-6 extra-info">
                      <div class="row">
                        <div class="col-md-6 mb-5">
                          <h3>Contact Info</h3>
                          <p>Queen Rania st <br> Amman</p>
                          <p>info@frameme.com</p>
                          <p>+962 70000 0000</p>

                        </div>
                        <div class="col-md-6">
                          <h3>Connect With Us</h3>
                          <ul class="list-unstyled">
                            <li><a href="#">X</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero overlay page-inside" style="background-image: url(img/other_background.jpg)">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center">
            <h1 class="heading" data-aos="fade-up"><?php echo $photographer_name ?></h1>
            <!-- <p class="sub-heading mb-5" data-aos="fade-up" data-aos-delay="100">Enjoy your stay.</p> -->
          </div>
        </div>
        <!-- <a href="#" class="scroll-down">Scroll Down</a> -->
      </div>
    </section>
    <!-- END section -->




    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.php"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/image00001.jpeg" alt="" />

                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Update Account
                      </h5>

                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Account.php" >


                    <input type="hidden" name="C_ID" value="<?php echo $C_ID ?>">


                      <div class="col-12 mb-2">
                        <label for="yourName" class="form-label"
                          >Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="yourName"
                          value="<?php echo $name ?>"
                          required
                        />

                      </div>

                      <div class="col-12 mb-2">
                        <label for="yourEmail" class="form-label"
                          >Email</label
                        >
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          id="yourEmail"
                          value="<?php echo $email ?>"
                          required
                        />

                      </div>


                      <div class="col-12 mb-2">
                        <label for="yourPhone" class="form-label"
                          >Phone</label
                        >
                        <input
                          type="text"
                          name="phone"
                          class="form-control"
                          id="yourPhone"
                          value="<?php echo $phone ?>"
                          pattern="[0-9]{10}" title="Phone Number Must Be 10 Numbers"
                          required
                        />
                      </div>


                      <div class="col-12 mb-3">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          value="<?php echo $password ?>"
                          required
                        />

                      </div>




                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100"
                          type="submit"
                          name="Submit"
                        >
                          Update
                        </button>
                      </div>

                    </form>
                  </div>
                </div>

                <div class="credits"></div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>




    <?php include './Footer.php';?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>