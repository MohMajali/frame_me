<?php

include "../Connect.php";
$Status = $_GET['Status'];
$reservation_id = $_GET['reservation_id'];

$stmt = $con->prepare("UPDATE reservations SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $Status, $reservation_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
alert ('Reservation Has Been Canceled !');
</script>";

    echo "<script language='JavaScript'>
document.location='./Reservations.php';
</script>";

}
