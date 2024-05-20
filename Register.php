<?php
session_start();

include "./Connect.php";

if (isset($_POST['Submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = '+962' . $_POST['phone'];
    $image = 'Photographer_Images/default_user.jpg';
    $userTypeId = $_POST['user_type_id'];
    $category_id = $_POST['category_id'];
    $price_range = "0.00";
    $total_rate = 0;

    $subscription_type = $_POST['subscription_type'];
    $start_date = $_POST['start_date'];
    $end_date = "";
    $price = "";
    $payment_type = "CASH";

    $start_timestamp = strtotime("$start_date");
    $end_timestamp = strtotime("$end_date");

    if ($subscription_type == 1) {

        $end_date = date('d-m-Y', strtotime($start_date . ' +30 days'));
        $price = 50;

    } else if ($subscription_type == 2) {

        $end_date = date('d-m-Y', strtotime($start_date . ' +60 days'));
        $price = 90;

    } else if ($subscription_type == 3) {

        $end_date = date('d-m-Y', strtotime($start_date . ' +90 days'));
        $price = 130;

    } else if ($subscription_type == 6) {

        $end_date = date('d-m-Y', strtotime($start_date . ' +180 days'));
        $price = 250;
    }

    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo '<script language="JavaScript">
        alert ("Sorry, User Already Exist !")
          </script>';

        echo '<script language="JavaScript">
        document.location="./Login.php";
        </script>';

    } else {
        $stmt = $con->prepare("INSERT INTO users (name, email, password, phone, image, user_type_id, total_rate, price_range) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");

        $stmt->bind_param("sssssidd", $name, $email, $password, $phone, $image, $userTypeId, $total_rate, $price_range);

        if ($stmt->execute()) {

            if ($category_id) {

                $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {

                    $stmt->bind_result($photographerid);
                    $stmt->fetch();




                    $isLoopDone = false;


                    foreach($category_id as $key => $categoryId){

                      $photo = $_FILES["file-" . $categoryId]["name"];
                      $photo = 'Photographer_Images/' . $photo;

                      $stmt = $con->prepare("INSERT INTO photographer_pictures (category_id, photographer_id, image) VALUES (?, ?, ?) ");

                      $stmt->bind_param("iis", $categoryId, $photographerid, $photo);


                      $stmt->execute();

                      move_uploaded_file($_FILES["file-" . $categoryId]["tmp_name"], "./Photographer_Dashboard/Photographer_Images/" . $_FILES["file-" . $categoryId]["name"]);


                      $photographerCategoryStmt = $con->prepare("INSERT INTO phorographer_categories (photographer_id, category_id) VALUES (?, ?) ");

                      $photographerCategoryStmt->bind_param("ii", $photographerid, $categoryId);


                      $photographerCategoryStmt->execute();


                    }


                    $isLoopDone = true;


                    if ($isLoopDone) {

                        $stmt2 = $con->prepare("SELECT id FROM users WHERE email = ?");
                        $stmt2->bind_param("s", $email);
                        $stmt2->execute();
                        $stmt2->store_result();

                        if ($stmt2->num_rows > 0) {

                            $stmt2->bind_result($id);
                            $stmt2->fetch();

                            $stmt = $con->prepare("INSERT INTO photographer_subscriptions (photographer_id, subscription_type, start_date, end_date, payment_type, price)
                      VALUES (?, ?, ?, ?, ?, ?) ");

                            $stmt->bind_param("issssi", $id, $subscription_type, $start_date, $end_date, $payment_type, $price);

                            if ($stmt->execute()) {

                                echo "<script language='JavaScript'>
                        alert ('Registration Success, Please Wait for Admin Response !');
                   </script>";

                                echo "<script language='JavaScript'>
                  document.location='./Login.php';
                     </script>";

                            }

                        }

                    }

                }
            } else {

                echo "<script language='JavaScript'>
                alert ('Registration Success, You Can Login Now !');
           </script>";

                echo "<script language='JavaScript'>
          document.location='./Login.php';
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

    <title>Register Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/image00001.jpeg" rel="icon" />
    <link href="assets/img/image00001.jpeg" rel="apple-touch-icon" />

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
                class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center"
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
                        Create an Account
                      </h5>
                      <p class="text-center small">
                        Enter your personal details to create account
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" method="POSt" action="./Register.php" enctype="multipart/form-data">



                      <div class="col-md-6">
                        <label for="yourName" class="form-label"
                          >Your Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="yourName"
                          required
                        />
                        <div class="invalid-feedback">
                          Please, enter your name!
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="yourEmail" class="form-label"
                          >Your Email</label
                        >
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          id="yourEmail"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter a valid Email adddress!
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="yourPhone" class="form-label"
                          >Phone Number</label
                        >
                        <input
                          type="number"
                          min=0
                          name="phone"
                          class="form-control"
                          id="yourPhone"
                          pattern="[0-9]{10}" title="Phone Number Must Be 10 Numbers"
                          required
                        />
                        <div class="invalid-feedback">
                          Phone Number Must Be 10 Numbers!
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                          title="Must Contain At Least One Number And One Uppercase And Lowercase Letter, And At Least 8 Or More Characters"
                          required
                        />
                        <div class="invalid-feedback">
                        Password Must be at least One Upper case, One Lower Case, Numbers & Symbols
                        </div>
                      </div>


                      <div class="col-12">
                        <label for="defaultSelect" class="form-label">Select Role</label>
                        <select onchange="onChangeUserRole(event)" id="defaultSelect" name="user_type_id" class="form-select" required>
                          <option value="2">Photographer</option>
                          <option value="3">Customer</option>
                        </select>
                      </div>






                      <div class="col-12" id="subscription_type">
                        <label for="defaultSelect" class="form-label">Subcription</label>
                        <select id="defaultSelect" name="subscription_type" class="form-select">
                          <!-- 1 Month -->
                          <option value="1">1 Month (50 JDs)</option>
                           <!--2 Months  -->
                          <option value="2">2 Months (90 JDs)</option>
                          <!-- 3 Months -->
                          <option value="3">3 Months (130 JDs)</option>
                          <!-- 6 Months -->
                          <option value="6">6 Months (250 JDs)</option>
                        </select>
                      </div>



                      <div class="col-12" id="start_date">
                        <label for="picture" class="form-label"
                          >Start Date</label
                        >
                        <input
                          type="date"
                          name="start_date"
                          class="form-control"
                          id="picture"
                        />
                      </div>

<div id="category_list">

                      <?php
$sql1 = mysqli_query($con, "SELECT * from categories WHERE active = 1");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['id'];
    $category = $row1['category'];

    ?>
                      <div class="col-12" >
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        name="category_id[]"
                        type="checkbox"
                        value="<?php echo $category_id ?>"
                        id="gridCheck"
                        onclick="categoryChecked(event)"
                      />
                      <label class="form-check-label" for="gridCheck">
                        <?php echo $category ?>
                      </label>
                    </div>
                  </div>


                  <div class="col-12" style="display: none;" id="photo_image-<?php echo $category_id ?>">
                        <label for="picture" class="form-label"
                          >Picture</label
                        >
                        <input
                          type="file"
                          name="file-<?php echo $category_id ?>"
                          class="form-control"
                          id="picture"
                        />
                      </div>

<?php
}?>
</div>



                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100"
                          type="submit"
                          name="Submit"
                        >
                          Create Account
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Already have an account?
                          <a href="./Login.php">Log in</a>
                        </p>
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
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


    <script>


      const categoryChecked = (e) => {

        let photoDiv = document.getElementById(`photo_image-${e.target.value}`)

        if(e.target.checked){

          photoDiv.style.display = 'block'

        } else {

          photoDiv.style.display = 'none'

        }
      }






      const onChangeUserRole = (e) => {

        let categoryDiv = document.getElementById('category_list')
        let photoDiv = document.getElementById('photo_image')
        let subscription_type = document.getElementById('subscription_type')
        let start_date = document.getElementById('start_date')
        let end_date = document.getElementById('end_date')

        if(e.target.value == 3){
          categoryDiv.style.display = 'none'
          photoDiv.style.display = 'none'
          subscription_type.style.display = 'none'
          start_date.style.display = 'none'
          end_date.style.display = 'none'
        } else {
          categoryDiv.style.display = 'block'
          photoDiv.style.display = 'block'
          subscription_type.style.display = 'block'
          start_date.style.display = 'block'
          end_date.style.display = 'block'

        }
      }

    </script>
  </body>
</html>
