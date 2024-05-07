<?php
session_start();

require_once '../Connect.php';

$gym_id = $_GET['gym_id'];
$C_ID = $_GET['C_ID'];
$Rate = $_GET['Rate'];

$sql5 = mysqli_query($con, "select * from gym_client_ratings where gym_id='$gym_id' AND client_id='$C_ID'");

if (mysqli_num_rows($sql5) > 0) {

    echo "<script language='JavaScript'>
			  alert ('Sorry .. You Already Rate This Gym Before !');
      </script>";

    echo '<script language="JavaScript">
 document.location="Subscriptions.php";
</script>';

} else {

    $sql3 = mysqli_query($con, "select * from gyms where id='$gym_id'");
    $row3 = mysqli_fetch_array($sql3);
    $Total_Rating = $row3['total_rate'];

    $New_Total_Rating = $Total_Rating + $Rate;

    mysqli_query($con, "insert into gym_client_ratings (gym_id,client_id,rate) values ('$gym_id','$C_ID','$Rate')");

    $sql3 = mysqli_query($con, "select * from gym_client_ratings where gym_id='$gym_id'");
    $num3 = mysqli_num_rows($sql3);
    $TR = $New_Total_Rating / $num3;

    mysqli_query($con, "update gyms set total_rate='$TR' where id='$gym_id'");

    echo "<script language='JavaScript'>
			  alert ('Thank You For Your Rate !');
      </script>";

    echo '<script language="JavaScript">
 document.location="Subscriptions.php";
</script>';

}
