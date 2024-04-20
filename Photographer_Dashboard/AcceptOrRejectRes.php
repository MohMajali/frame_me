<?php

include "../Connect.php";
$status = $_GET['status'];
$reservation_id = $_GET['reservation_id'];

$stmt = $con->prepare("UPDATE reservations SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $reservation_id);

if ($stmt->execute()) {

    if ($status == 'Accepted') {

        echo "<script language='JavaScript'>
        alert ('Reservation Has Been Accepted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Reservations.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Reservation Has Been Rejected Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Reservations.php';
</script>";
    }

}
