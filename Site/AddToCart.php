<?php

include "../Connect.php";

$response = array();

$qty = $_POST['qty'];
$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];

$stmt = $con->prepare("SELECT id, qty FROM carts WHERE customer_id = ? AND product_id = ?");
$stmt->bind_param("ii", $customer_id, $product_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {

    $stmt->bind_result($id, $oldQty);
    $stmt->fetch();

    $getQtyStmt = $con->prepare("SELECT quantity FROM store_items WHERE id = ?");

    $getQtyStmt->bind_param("i", $product_id);

    $getQtyStmt->execute();

    $getQtyStmt->store_result();

    if ($getQtyStmt->num_rows > 0) {

        $getQtyStmt->bind_result($quantity);
        $getQtyStmt->fetch();

        if ($oldQty < $qty) {

            $newQty = $quantity - $qty;

            $updateQtyItemStmt = $con->prepare("UPDATE store_items SET quantity = ? WHERE id = ? ");

            $updateQtyItemStmt->bind_param("ii", $newQty, $product_id);

            if ($updateQtyItemStmt->execute()) {

                $updateCartQtyItemStmt = $con->prepare("UPDATE carts SET qty = ? WHERE id = ? ");

                $updateCartQtyItemStmt->bind_param("ii", $qty, $id);

                if ($updateCartQtyItemStmt->execute()) {

                    $response['error'] = false;
                }

            }

        } else {

            $newQty = $quantity + $qty;

            $updateQtyItemStmt = $con->prepare("UPDATE store_items SET quantity = ? WHERE id = ? ");

            $updateQtyItemStmt->bind_param("ii", $newQty, $product_id);

            if ($updateQtyItemStmt->execute()) {

                $updateCartQtyItemStmt = $con->prepare("UPDATE carts SET qty = ? WHERE id = ? ");

                $updateCartQtyItemStmt->bind_param("ii", $qty, $id);

                if ($updateCartQtyItemStmt->execute()) {

                    $response['error'] = false;
                }

            }

        }

    }

} else {

    $AddStmt = $con->prepare("INSERT INTO carts (product_id, customer_id, qty) VALUES (?, ?, ?)");
    $AddStmt->bind_param("iii", $product_id, $customer_id, $qty);

    if ($AddStmt->execute()) {

        $getQtyStmt = $con->prepare("SELECT quantity FROM store_items WHERE id = ?");

        $getQtyStmt->bind_param("i", $product_id);

        $getQtyStmt->execute();

        $getQtyStmt->store_result();

        if ($getQtyStmt->num_rows > 0) {

            $getQtyStmt->bind_result($quantity);
            $getQtyStmt->fetch();

            $newQty = $quantity - $qty;

            $updateQtyItemStmt = $con->prepare("UPDATE store_items SET quantity = ? WHERE id = ? ");

            $updateQtyItemStmt->bind_param("ii", $newQty, $product_id);

            if ($updateQtyItemStmt->execute()) {

                $response['error'] = false;
            }

        }

    }

}

echo json_encode($response);
