<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$coach_id = $_GET['coach_id'];

$stmt = $con->prepare("UPDATE gym_coaches SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $coach_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Coach Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Coaches.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Coach Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Coaches.php';
</script>";
    }

}
