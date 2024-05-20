<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$photographer_id = $_GET['photographer_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    $sql1 = mysqli_query($con, "select * from users where id='$photographer_id'");
    $row1 = mysqli_fetch_array($sql1);

    $photographer_name = $row1['name'];
    $photographer_email = $row1['email'];
    $photographer_image = $row1['image'];
    $photographer_description = $row1['description'];

    if (isset($_POST['Submit'])) {
        $category_id = $_POST['category_id'];
        $photographer_id = $_POST['photographer_id'];
        $C_ID = $_POST['C_ID'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        $start_timestamp = strtotime("$start_date $start_time");
        $end_timestamp = strtotime("$end_date $end_time");

        if ($end_timestamp < $start_timestamp) {

            echo "<script language='JavaScript'>
          alert ('End Time/Date Must Be Greater Than Start Time/Date !');
     </script>";

        } else {
            $stmt = $con->prepare("INSERT INTO reservations (category_id, photographer_id, customer_id, start_date, end_date, start_time, end_time)
          VALUES (?, ?, ?, ?, ?, ?, ?) ");

            $stmt->bind_param("iiissss", $category_id, $photographer_id, $C_ID, $start_date, $end_date, $start_time, $end_time);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
              alert ('Reservation Success !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./Reservations.php';
           </script>";

            }
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
                        Make Reservation
                      </h5>

                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Make-Reservation.php?photographer_id=<?php echo $photographer_id ?>" >


                    <input type="hidden" name="photographer_id" id="photographer_id" value="<?php echo $photographer_id ?>">
                    <input type="hidden" name="C_ID" value="<?php echo $C_ID ?>">


                      <div class="col-12 mb-2">
                        <label for="category" class="form-label"
                          >Category</label
                        >

                            <select onchange="onChangeCategory(event)" name="category_id" id="category" class="form-control">
                            <?php
$sql1 = mysqli_query($con, "SELECT category_id from phorographer_categories");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['category_id'];


    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $category = $row2['category'];
    $category_image = $row2['image'];


    ?>
                                <option value="<?php echo $category_id ?>"><?php echo $category ?></option>
                                <?php
}?>
                            </select>

                      </div>

                      <div class="col-12 mb-2">
                        <label for="yourEmail" class="form-label"
                          >Start Date</label
                        >
                        <input
                          type="date"
                          name="start_date"
                          class="form-control"
                          id="yourEmail"
                          min="<?php echo date('Y-m-d'); ?>"
                          required
                        />

                      </div>

                      <div class="col-12 mb-2">
                        <label for="yourEmail" class="form-label"
                          >End Date</label
                        >
                        <input
                          type="date"
                          name="end_date"
                          class="form-control"
                          id="yourEmail"
                          min="<?php echo date('Y-m-d'); ?>"
                          required
                        />

                      </div>


                      <div class="col-12 mb-2">
                        <label for="yourEmail" class="form-label"
                          >Start Time</label
                        >
                        <input
                          type="time"
                          name="start_time"
                          class="form-control"
                          id="yourEmail"
                          required
                        />
                      </div>


                      <div class="col-12 mb-3">
                        <label for="yourPassword" class="form-label"
                          >End Time</label
                        >
                        <input
                          type="time"
                          name="end_time"
                          class="form-control"
                          id="yourPassword"
                          required
                        />

                      </div>


                      <div class="col-12 mb-3" >
                        <label for="accessories" class="form-label"
                          >Accessories</label
                        >

                        <div id="accessories_div">

                        </div>

                      </div>




                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100"
                          type="submit"
                          name="Submit"
                        >
                          Make Reservation
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



    <script>
      const onChangeCategory = (e) => {

        photographer_id = document.getElementById('photographer_id').value
        let accessoriesSection = $('#accessories_div')
        console.log(photographer_id, e.target.value);
        accessoriesArray = []

        $.ajax({
            type: 'GET',
            url: `./GetAccessories.php?photographer_id=${photographer_id}&category_id=${e.target.value}`,
            success: function(accessories){
              accessoriesArray = JSON.parse(accessories)

              accessoriesArray = accessoriesArray.map(acc => (`

              <li>${acc.accessorie}</li>


              `))

              accessoriesSection.html(accessoriesArray)

            },
            error: function(){
                alert('ERROR')
            }
        })
      }
    </script>
  </body>
</html>