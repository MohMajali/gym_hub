<?php

include "../Connect.php";

$status = $_GET['status'];
$subcription_id = $_GET['subcription_id'];

$stmt = $con->prepare("UPDATE clients_subscriptions SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $subcription_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Subscription Has Been Canceled !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./Subscriptions.php';
        </script>";

}
