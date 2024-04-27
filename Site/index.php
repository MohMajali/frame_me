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
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="Photographers.php">Photographers</a></li>
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

    <section class="site-hero overlay" style="background-image: url(img/index_background.jpeg)">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center">
            <h1 class="heading" data-aos="fade-up">Welcome to <em>Frame</em>Me</h1>
            <p class="sub-heading mb-5" data-aos="fade-up" data-aos-delay="100">XXXXXX XXXXXX XXXXXX &amp; XXXXXXX.</p>
            <!-- <p data-aos="fade-up" data-aos-delay="100"><a href="#" class="btn uppercase btn-primary mr-md-2 mr-0 mb-3 d-sm-inline d-block">Explore The Beauty</a> <a href="#" class="btn uppercase btn-outline-light d-sm-inline d-block">Download</a></p> -->
          </div>
        </div>
        <!-- <a href="#" class="scroll-down">Scroll Down</a> -->
      </div>
    </section>
    <!-- END section -->

    <section class="section visit-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading" data-aos="fade-right">Our Photographers</h2>
          </div>
        </div>
        <div class="row">


        <?php
$sql1 = mysqli_query($con, "SELECT * from users WHERE user_type_id = 2 AND active = 1 AND request_status = 'Accepted' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $photographer_id = $row1['id'];
    $name = $row1['name'];
    $image = $row1['image'];
    $total_rate = $row1['total_rate'];

    ?>
          <div class="col-lg-3 col-md-6 visit mb-3" data-aos="fade-right">
            <a href="./Photographer.php?photographer_id=<?php echo $photographer_id ?>"><img src="../Photographer_Dashboard/<?php echo $image ?>" alt="Image placeholder" class="img-fluid"> </a>
            <h3><a href="./Photographer.php?photographer_id=<?php echo $photographer_id ?>"><?php echo $name ?></a></h3>
            <div class="reviews-star float-left">
              <?php for ($i = 0; $i < $total_rate; $i++) {?>
                <span class="ion-android-star"></span>
              <?php }?>
            </div>

          </div>
          <?php
}?>
        </div>
      </div>
    </section>
    <!-- END section -->



    <section class="section blog-post-entry bg-pattern">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up">Our Categories</h2>
            <p class="lead" data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In dolor, iusto doloremque quo odio repudiandae sunt eveniet? Enim facilis laborum voluptate id porro, culpa maiores quis, blanditiis laboriosam alias. Sed.</p>
          </div>
        </div>
        <div class="row">
        <?php
$sql1 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['id'];
    $category = $row1['category'];
    $category_image = $row1['image'];

    ?>
          <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4">
              <a href="./Photographers.php?category_id=<?php echo $category_id ?>" class="mb-4 d-block"><img src="../Admin_Dashboard/<?php echo $category_image ?>" alt="Image placeholder" class="img-fluid"></a>
              <div class="media-body">
                <!-- <span class="meta-post">February 26, 2018</span> -->
                <h2 class="mt-0 mb-3"><a href="#"><?php echo $category ?></a></h2>
              </div>
            </div>
          </div>
          <?php
}?>
        </div>
      </div>
    </section>

    <section class="section slider-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up">Some of Photographers Works</h2>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In dolor, iusto doloremque quo odio repudiandae sunt eveniet? Enim facilis laborum voluptate id porro, culpa maiores quis, blanditiis laboriosam alias. Sed.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
            <?php
$sql1 = mysqli_query($con, "SELECT * from photographer_pictures ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $photo_id = $row1['id'];
    $photo = $row1['image'];
    $category_photo_id = $row1['category_id'];

    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_photo_id'");
    $row1 = mysqli_fetch_array($sql2);

    $category_photo = $row1['category'];

    ?>

              <div id="img-<?php echo $photo_id ?>" class="slider-item">
                <img src="../Photographer_Dashboard/<?php echo $photo ?>" alt="Image placeholder" class="img-fluid" height="120px">
                <h3 class="text-center"><?php echo $category_photo ?></h3>
              </div>
              <?php
}?>

            </div>
            <!-- END slider -->
          </div>

          <!-- <div class="col-md-12 text-center"><a href="#" class="">View More Photos</a></div> -->

        </div>
      </div>
    </section>
    <!-- END section -->


    <!-- END section -->
    <section class="section testimonial-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up">Testimonial</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial text-center">
              <div class="author-image mb-3">
                <img src="img/person_1.jpg" alt="Image placeholder" class="rounded-circle">
              </div>
              <blockquote>

                <p>&ldquo;This website is awesome.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; Moh Majali</em></p>

            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial text-center">
              <div class="author-image mb-3">
                <img src="img/person_2.jpg" alt="Image placeholder" class="rounded-circle">
              </div>
              <blockquote>
                <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. In dolor, iusto doloremque quo odio repudiandae sunt eveniet? Enim facilis laborum voluptate id porro, culpa maiores quis, blanditiis laboriosam alias&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial text-center">
              <div class="author-image mb-3">
                <img src="img/person_3.jpg" alt="Image placeholder" class="rounded-circle">
              </div>
              <blockquote>

                <p>&ldquo;Nostrum, alias, provident magnam sit blanditiis laboriosam unde quaerat, at ipsam, ratione maiores saepe nisi modi corporis quas! Beatae quam, quod aspernatur debitis nesciunt quasi porro ea iste nobis aliquid perspiciatis nostrum culpa impedit aut, iure blanditiis itaque similique sunt!&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
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
    <!-- <script src="js/jquery.waypoints.min.js"></script> -->
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>