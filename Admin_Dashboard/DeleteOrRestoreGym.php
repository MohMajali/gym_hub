<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$gym_id = $_GET['gym_id'];

$stmt = $con->prepare("UPDATE gyms SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $gym_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Gym Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Gyms.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Gym Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Gyms.php';
</script>";
    }

}
