<?php
session_start();

include "../Connect.php";

unset($_SESSION['C_Log']);

echo "<script language='JavaScript'>
			alert ('You Logout Successfully !');
      </script>";

echo '<script language="JavaScript">
        document.location="./index.php";
    </script>';
?>
