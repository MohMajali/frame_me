<?php

include "../Connect.php";

$picture_id = $_GET['picture_id'];

$stmt = $con->prepare("DELETE FROM photographer_pictures WHERE id = ? ");

$stmt->bind_param("i", $picture_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
            alert ('Picture Has Been Deleted Successfully !');
            </script>";

    echo "<script language='JavaScript'>
            document.location='./Photos.php';
            </script>";

}
