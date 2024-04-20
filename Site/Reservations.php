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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Photographers.php">Photographers</a></li>
                        <li><a href="about.php">About</a></li>
                        <?php if ($C_ID) {?>
                        <li class="active"><a href="Reservations.php">Reservations</a></li>
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
                         Reservations
                      </h5>

                    </div>

                <div class="card">
                <h5 class="card-header">Reservations</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                        <th scope="col">ID</th>
                      <th scope="col">Photographer Name</th>
                      <th scope="col">Cateogory Name</th>
                      <th scope="col">Date Time</th>
                      <th scope="col">Status</th>
                      <th scope="col">Total Price</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>


                      <?php
$sql1 = mysqli_query($con, "SELECT * from reservations WHERE customer_id = '$C_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $reservation_id = $row1['id'];
    $status = $row1['status'];
    $category_id = $row1['category_id'];
    $photographer_id = $row1['photographer_id'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $start_time = $row1['start_time'];
    $end_time = $row1['end_time'];
    $total_price = $row1['total_price'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $category_name = $row2['category'];

    $sql3 = mysqli_query($con, "SELECT * from users WHERE id = '$photographer_id'");
    $row3 = mysqli_fetch_array($sql3);

    $photographer_name = $row3['name'];

    $sql4 = mysqli_query($con, "SELECT * from customer_photographer_rates WHERE photographer_id = '$photographer_id' AND customer_id = '$C_ID'");
    $row4 = mysqli_fetch_array($sql4);

    $rate_id = $row4['id'];



    ?>
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $reservation_id ?></strong>
                          </td>
                          <td><?php echo $photographer_name ?></td>
                          <td>
                          <?php echo $category_name ?>
                          </td>
                          <td><span class="badge bg-label-primary me-1"><?php echo $start_date ?> - <?php echo $end_date ?> - <?php echo $start_time ?> - <?php echo $end_time ?></span></td>
                          <td><span class="badge bg-label-primary me-1"><?php echo $status ?></span></td>
                          <td><span class="badge bg-label-primary me-1"><?php

    if ($total_price) {
        echo $total_price;
    } else {
        echo "-";
    }

    ?></span></td>
                          <td><span class="badge bg-label-primary me-1"><?php echo $created_at ?></span></td>
                          <td>
                          <?php if ($status == 'Pending') {?>

<a href="JavaScript:if(confirm('Are You Sure To Cancel This Resertvation ?')==true)
{window.location='./CancelReservation.php?reservation_id=<?php echo $reservation_id ?>&&Status=Canceled';}" class="btn btn-danger">Cancel</a>


<?php } else if($status == 'Accepted' && !$rate_id) {?>

  <a href="Rate.php?Rate=1&photographer_id=<?php echo $photographer_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button"><i title="1" style="color:#fad00e" class="fa fa-star"></i></a>

 <a href="Rate.php?Rate=2&photographer_id=<?php echo $photographer_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button"><i title="2" style="color:#fad00e" class="fa fa-star"></i></a>

 <a href="Rate.php?Rate=3&photographer_id=<?php echo $photographer_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button"><i title="3" style="color:#fad00e" class="fa fa-star"></i></a>

 <a href="Rate.php?Rate=4&photographer_id=<?php echo $photographer_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button"><i title="4" style="color:#fad00e" class="fa fa-star"></i></a>

 <a href="Rate.php?Rate=5&photographer_id=<?php echo $photographer_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button"><i title="5" style="color:#fad00e" class="fa fa-star"></i></a>




<?php } else { ?>

  <a href="./Add-Review.php?reservation_id=<?php echo $reservation_id ?>" class="btn btn-danger">Add Review</a>

<?php } ?>
                          </td>
                        </tr>
                        <?php
}?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!-- End Table with stripped rows -->
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