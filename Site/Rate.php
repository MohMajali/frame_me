<?php
session_start();

require_once '../Connect.php';

$photographer_id = $_GET['photographer_id'];
$C_ID = $_GET['C_ID'];
$Rate = $_GET['Rate'];

$sql5 = mysqli_query($con, "select * from customer_photographer_rates where photographer_id='$photographer_id' AND customer_id='$C_ID'");

if (mysqli_num_rows($sql5) > 0) {

    echo "<script language='JavaScript'>
			  alert ('Sorry .. You Already Rate This Seller Before !');
      </script>";

    echo '<script language="JavaScript">
 document.location="Reservations.php";
</script>';

} else {

    $sql3 = mysqli_query($con, "select * from users where id='$photographer_id'");
    $row3 = mysqli_fetch_array($sql3);
    $Total_Rating = $row3['total_rate'];

    $New_Total_Rating = $Total_Rating + $Rate;

    mysqli_query($con, "insert into customer_photographer_rates (photographer_id,customer_id,rate) values ('$photographer_id','$C_ID','$Rate')");

    $sql3 = mysqli_query($con, "select * from customer_photographer_rates where photographer_id='$photographer_id'");
    $num3 = mysqli_num_rows($sql3);
    $TR = $New_Total_Rating / $num3;

    mysqli_query($con, "update users set total_rate='$TR' where id='$photographer_id'");

    echo "<script language='JavaScript'>
			  alert ('Thank You For Your Rate !');
      </script>";

    echo '<script language="JavaScript">
 document.location="Reservations.php";
</script>';

}
