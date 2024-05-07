<?php
include "../Connect.php";

$photographer_id = $_GET['photographer_id'];
$category_id = $_GET['category_id'];

$response = array();

$sql1 = mysqli_query($con, "SELECT accessorie from photographer_accessories WHERE category_id = '$category_id' AND photographer_id = '$photographer_id'");

while ($row1 = mysqli_fetch_array($sql1)) {

    $response[] = $row1;

}


echo json_encode($response);
