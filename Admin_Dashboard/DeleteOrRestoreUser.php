<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$user_id = $_GET['user_id'];
$isCustomer = $_GET['isCustomer'];

$stmt = $con->prepare("UPDATE users SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $user_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        if ($isCustomer) {
            echo "<script language='JavaScript'>
            alert ('Customer Has Been Deleted Successfully !');
            </script>";

            echo "<script language='JavaScript'>
            document.location='./Customers.php';
            </script>";
        } else {

            echo "<script language='JavaScript'>
            alert ('Photographer Has Been Deleted Successfully !');
            </script>";

            echo "<script language='JavaScript'>
            document.location='./Photographers.php';
            </script>";
        }

    } else {

        if ($isCustomer) {
            echo "<script language='JavaScript'>
    alert ('Customer Has Been Deleted Successfully !');
    </script>";

            echo "<script language='JavaScript'>
    document.location='./Customers.php';
    </script>";
        } else {

            echo "<script language='JavaScript'>
    alert ('Photographer Has Been Deleted Successfully !');
    </script>";

            echo "<script language='JavaScript'>
    document.location='./Photographers.php';
    </script>";
        }
    }

}
