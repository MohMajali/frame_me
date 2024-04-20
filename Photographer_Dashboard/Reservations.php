<?php
session_start();

include "../Connect.php";

$P_ID = $_SESSION['P_Log'];

if (!$P_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

} else {
    $sql1 = mysqli_query($con, "select * from users where id='$P_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
    $phone = $row1['phone'];
    $image = $row1['image'];
    $request_status = $row1['request_status'];

    if ($request_status == 'Pending') {
        echo '<script language="JavaScript">
      document.location="./Photos.php";
     </script>';
    } else {
        if (isset($_POST['Submit'])) {

            $reservation_id = $_POST['reservation_id'];
            $total_price = $_POST['total_price'];

            $stmt = $con->prepare("UPDATE reservations SET total_price = ? WHERE id = ? ");

            $stmt->bind_param("di", $total_price, $reservation_id);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
              alert ('Price Has Been Updated Successfully !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./Reservations.php';
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
        <a href="index.html" class="logo d-flex align-items-center">
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
        <h1>Reservations</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
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
                <h5 class="modal-title">Set Price</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Reservations.php" enctype="multipart/form-data">

                <input id="reservation_id_id" type="hidden" name="reservation_id" class="form-control" />


                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      > Price</label
                    >
                    <div class="col-sm-8">
                      <input type="number" name="total_price" class="form-control" />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="Submit" class="btn btn-primary">
                        Submit
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
                      <th scope="col">Customer Name</th>
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
$sql1 = mysqli_query($con, "SELECT * from reservations WHERE photographer_id = '$P_ID' ORDER BY id DESC");

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
                      <td><?php

    if ($total_price) {
        echo $total_price;
    } else {
        echo "-";
    }

    ?> </td>
                      <td><?php echo $created_at ?> </td>
                      <td>

                      <?php
if ($status == 'Pending') {
        ?>
                      <a href="./AcceptOrRejectRes.php?reservation_id=<?php echo $reservation_id ?>&status=Accepted" class="btn btn-primary">Accept</a>
                      <a href="./AcceptOrRejectRes.php?reservation_id=<?php echo $reservation_id ?>&status=Rejected" class="btn btn-danger">Reject</a>
<?php
} else {?>

<?php if (!$total_price && $status == 'Accepted') {?>



  <div class="mb-3">
          <button
          id="btn-<?php echo $reservation_id ?>"
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verticalycentered"
            onclick="onClick(event)"
          >
          Set Price
          </button>
        </div>

<?php }?>
<?php
}?>
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(5) .nav-link').classList.remove('collapsed')
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

    <script>

      const onClick = (e) => {
        document.getElementById('reservation_id_id').value = e.target.id.split("-")[1]
      }
    </script>

  </body>
</html>
