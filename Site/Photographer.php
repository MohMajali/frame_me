<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$category_id = $_GET['category_id'];
$photographer_id = $_GET['photographer_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

$sql1 = mysqli_query($con, "select * from users where id='$photographer_id'");
$row1 = mysqli_fetch_array($sql1);

$photographer_name = $row1['name'];
$photographer_email = $row1['email'];
$photographer_image = $row1['image'];
$photographer_description = $row1['description'];

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
                        <li class="active"><a href="Photographers.php">Photographers</a></li>
                        <li><a href="Categories.php">Categories</a></li>
                        <li><a href="about.php">About</a></li>
                        <?php if ($C_ID) {?>
                        <li><a href="Reservations.php">Reservations</a></li>
                        <li><a href="Account.php">Account</a></li>
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
                          <p>Queen Rania <br> Amman</p>
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

    <section class="site-hero overlay page-inside" style="background-image: url(img/photographer.jpeg)">
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

    <section class="bg-light">
      <div class="half d-md-flex d-block">
        <div class="image" data-aos="fade" style="background-image: url('../Photographer_Dashboard/<?php echo $photographer_image ?>');"></div>
        <div class="text" data-aos="fade-right" data-aos-delay="200">
          <h2><?php echo $photographer_name ?></h2>

          <p><?php echo $photographer_description ?></p>

          <?php if ($C_ID) {?>
           <div class="row">
                <div class="col-md-6 form-group">
                  <a href="./Make-Reservation.php?photographer_id=<?php echo $photographer_id ?>" class="btn btn-primary">Set Reservation</a>
                </div>
              </div> 
          <?php }?>

        </div>
      </div>



    </section>
    <!-- END section -->

    <section class="section slider-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up"><?php echo $photographer_name ?> Gallery</h2>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Some of My Work</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
            <?php
$sql1 = mysqli_query($con, "SELECT * from photographer_pictures WHERE photographer_id = '$photographer_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $photo_id = $row1['id'];
    $photo = $row1['image'];

    ?>
              <div class="slider-item">
                <img src="../Photographer_Dashboard/<?php echo $photo ?>" alt="Image placeholder" class="img-fluid">
              </div>
              <?php
}?>
            </div>
            <!-- END slider -->
          </div>


        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="section blog-post-entry bg-pattern">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up">More Works Of Mine</h2>
            <!-- <p class="lead" data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In dolor, iusto doloremque quo odio repudiandae sunt eveniet? Enim facilis laborum voluptate id porro, culpa maiores quis, blanditiis laboriosam alias. Sed.</p> -->
          </div>
        </div>
        <div class="row">
        <?php
$sql1 = mysqli_query($con, "SELECT * from photographer_pictures WHERE photographer_id = '$photographer_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $photo_id = $row1['id'];
    $photo = $row1['image'];
    $photographer_pictures_category_id = $row1['category_id'];

    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$photographer_pictures_category_id' ORDER BY id DESC");
    $row2 = mysqli_fetch_array($sql2);

    $category = $row2['category'];

    ?>

          <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">
            <h3><?php echo $category ?></h3>
            <div class="media media-custom d-block mb-4">
              <a href="#" class="mb-4 d-block"><img src="../Photographer_Dashboard/<?php echo $photo ?>" alt="Image placeholder" class="img-fluid"></a>
              <div class="media-body">
              </div>
            </div>

          </div>
          <?php
}?>


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