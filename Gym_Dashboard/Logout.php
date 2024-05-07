<?php
session_start();

include "../Connect.php";

unset($_SESSION['G_Log']);

echo "<script language='JavaScript'>
			alert ('You Logout Successfully !');
      </script>";

echo '<script language="JavaScript">
        document.location="../Gym_Login.php";
    </script>';
?>
