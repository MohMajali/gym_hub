<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$item_id = $_GET['item_id'];

$stmt = $con->prepare("UPDATE store_items SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $item_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Item Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Store_Items.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Item Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Store_Items.php';
</script>";
    }

}
