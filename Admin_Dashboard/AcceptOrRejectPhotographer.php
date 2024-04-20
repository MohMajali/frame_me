<?php

include "../Connect.php";
$status = $_GET['status'];
$photographer_id = $_GET['photographer_id'];

$stmt = $con->prepare("UPDATE users SET request_status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $photographer_id);

if ($stmt->execute()) {

    if ($status == 'Accepted') {

        echo "<script language='JavaScript'>
        alert ('Photographer Has Been Accepted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Photographers.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Photographer Has Been Rejected Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Photographers.php';
</script>";
    }

}
