<?php
session_start();

include "../Connect.php";

$A_ID = $_SESSION['A_Log'];
$isReport = $_GET['isReport'];

if (!$A_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Reservations - FrameMe</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/logo_1.png" rel="icon" />
    <link href="../assets/img/logo_1.png" rel="apple-touch-icon" />

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
          <img src="../assets/img/logo_1.png" alt="" />

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
              <span class="d-none d-md-block ps-2"><?php echo $name ?></span> </a
            ><!-- End Profile Iamge Icon -->
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
        <h1>Reservations</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Reservations</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">


      <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Reservation</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="#" enctype="multipart/form-data">
                  <div class="row mb-3">
             
                    <div class="col-sm-12">
                      <textarea id="text-area-res" class="form-control" id="" cols="30" rows="10"></textarea>
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

      <?php if($isReport){?>
      
      <div class="mb-3">

<input type="button" value="PRINT REPORT" class="btn btn-primary" onclick="printDiv()">
</div>
    
    
      <?php }?>



      <div class="row" id="div_print">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Photographer Name</th>
                      <th scope="col">Cateogory Name</th>
                      <th scope="col">Session Date</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sql1 = mysqli_query($con, "SELECT * from reservations ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $reservation_id = $row1['id'];
    $status = $row1['status'];
    $category_id = $row1['category_id'];
    $photographer_id = $row1['photographer_id'];
    $customer_id = $row1['customer_id'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $start_time = $row1['start_time'];
    $end_time = $row1['end_time'];
    $total_price = $row1['total_price'];
    $created_at = $row1['created_at'];
    $review = $row1['review'];

    $sql2 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $category_name = $row2['category'];

    $sql3 = mysqli_query($con, "SELECT * from users WHERE id = '$photographer_id'");
    $row3 = mysqli_fetch_array($sql3);

    $photographer_name = $row3['name'];

    $sql4 = mysqli_query($con, "SELECT * from users WHERE id = '$customer_id'");
    $row4 = mysqli_fetch_array($sql4);

    $customer_name = $row4['name'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $reservation_id ?></th>
                      <td><?php echo $customer_name ?></td>
                      <td><?php echo $photographer_name ?></td>
                      <td><?php echo $category_name ?></td>
                      <td><?php echo $start_date ?> - <?php echo $end_date ?> - <?php echo $start_time ?> - <?php echo $end_time ?></td>
                      <td><?php echo $status ?> </td>
                      <td><?php echo $created_at ?> </td>
                      <td><?php 
                      
                      if($review){ ?>
                         <button 
                        id="btn-<?php echo $review?>"
                        onclick="onClickBtn(event)"
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#verticalycentered">View Review</button>
                    <?php   } ?>
                      
                      
                       </td>



                    </tr>
<?php }?>
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
        &copy; Copyright <strong><span>FrameMe</span></strong
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(6) .nav-link').classList.remove('collapsed')
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

    <?php if($isReport){?>
      <script>
        function printDiv() {
            var divContents = document.getElementById("div_print").innerHTML;
            var a = window.open('', '', 'height=1000, width=5000');
            a.document.write('<html>');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
    <?php }?>

    <script>
              const onClickBtn = (e) => {
          document.getElementById('text-area-res').value = e.target.id.split('-')[1]
        }
    </script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

  </body>
</html>
