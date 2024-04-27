<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

if (isset($_POST['Submit'])) {

    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $con->prepare("INSERT INTO contact_us (full_name, phone, email, message)
  VALUES (?, ?, ?, ?) ");

    $stmt->bind_param("ssss", $full_name, $phone, $email, $message);

    if ($stmt->execute()) {

        echo "<script language='JavaScript'>
      alert ('Thank You For Contacting Us !');
 </script>";

        echo "<script language='JavaScript'>
document.location='./contact.php';
   </script>";

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
          <div class="col-4 site-logo" data-aos="fade"><a href="index.html"><em>FrameMe</em></a></div>
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
                        <li><a href="about.php">About</a></li>
                        <?php if ($C_ID) {?>
                        <li><a href="Reservations.php">Reservations</a></li>
                        <li><a href="Account.php">Account</a></li>
                        <?php } else {?>
                          <li><a href="../Login.php">Login</a></li>

                          <?php }?>
                        <li class="active"><a href="contact.php">Contact</a></li>

                        <?php if ($C_ID) {?>
                        <li><a href="./logout.php">Logout</a></li>

                        <?php }?>
                      </ul>
                    </div>
                    <div class="col-md-6 extra-info">
                      <div class="row">
                        <div class="col-md-6 mb-5">
                          <h3>Contact Info</h3>
                          <p>98 West 21th Street, Suite 721 <br> New York NY 10016</p>
                          <p>info@frameme.com</p>
                          <p>+962 70000 0000</p>

                        </div>
                        <div class="col-md-6">
                          <h3>Connect With Us</h3>
                          <ul class="list-unstyled">
                            <li><a href="#">Twitter</a></li>
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
            <h1 class="heading" data-aos="fade-up">Contact</h1>
            <p class="sub-heading mb-5" data-aos="fade-up" data-aos-delay="100">Get in touch with us.</p>
          </div>
        </div>
        <!-- <a href="#" class="scroll-down">Scroll Down</a> -->
      </div>
    </section>
    <!-- END section -->


    <section class="section bg-primary contact-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">

            <form action="contact.php" method="post" class="bg-white p-md-5 p-4 mb-5" style="margin-top: -150px;">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="full_name" id="name" class="form-control ">
                </div>
                <div class="col-md-6 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control ">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control ">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message">Write Message</label>
                  <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Send Message" name="Submit" class="btn btn-primary">
                </div>
              </div>
            </form>

          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-10 ml-auto contact-info">
                <p><span class="d-block">Address:</span> <span> 98 West 21th Street, Suite 721 New York NY 10016</span></p>
                <p><span class="d-block">Phone:</span> <span> +962 70000 0000</span></p>
                <p><span class="d-block">Email:</span> <span> info@frameme.com</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


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