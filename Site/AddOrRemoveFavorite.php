<?php

include "../Connect.php";

$favorite_id = $_GET['favorite_id'];
$customer_id = $_GET['customer_id'];
$product_id = $_GET['product_id'];

if ($favorite_id) {

    $stmt = $con->prepare("DELETE FROM customer_favorities WHERE id = ? ");
    $stmt->bind_param("i", $favorite_id);

    if ($stmt->execute()) {

        echo "<script language='JavaScript'>
                document.location='./index.php';
                </script>";

    }
} else {

    $stmt = $con->prepare("INSERT INTO customer_favorities (customer_id, product_id) VALUES (?, ?) ");
    $stmt->bind_param("ii", $customer_id, $product_id);

    if ($stmt->execute()) {

        echo "<script language='JavaScript'>
                document.location='./index.php';
                </script>";

    }
}
