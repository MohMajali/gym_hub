<?php

include "../Connect.php";

$status = $_GET['status'];
$page = $_GET['page'];
$subcription_id = $_GET['subcription_id'];

$stmt = $con->prepare("UPDATE clients_subscriptions SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $subcription_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Customer Subscription Has Been {$status} Successfully !');
        </script>";

    if ($page == 'active') {

        echo "<script language='JavaScript'>
            document.location='./Active_Subscriptions.php';
            </script>";
    } else if ($page == 'cancel') {

        echo "<script language='JavaScript'>
            document.location='./Canceled_Subscriptions.php';
            </script>";

    } else if ($page == 'deactive') {

        echo "<script language='JavaScript'>
            document.location='./DeActivated_Subscriptions.php';
            </script>";
    }

}
