<?php
session_start();
include_once("./db-driver.php");

if (isset($_POST['smOrders'])) {
    // Get customer information
    $customerName       = $_POST['customerName'];
    $customerBirthday   = $_POST['customerBirthday'];
    $customerAddress    = $_POST['customerAddress'];
    $customerEmail      = $_POST['customerEmail'];
    $customerPhone      = $_POST['customerPhone'];
    $customerGender     = $_POST['customerGender'];
    if (!empty($customerName && $customerGender && $customerPhone)) {
        insert_customer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday);
    } else {
        echo "<script>alert('Do not leave the required fields blank');</script>";
        echo "<script>window.location='../create-orders.php';</script>";
    }

    if (isset($_SESSION['u_id'])) {
        $staffID = $_SESSION['u_id'];
        $dateCreated = date("Y-m-d h:i");
        create_orders($customerName, $staffID, $dateCreated);
    } else {
        echo "<script>alert('Please login again!');</script>";
        echo "<script>window.location='../create-orders.php';</script>";
    }

    $chooseID = $_POST['chooseID'];
    // print_r(var_dump($chooseID));
    if (!empty($chooseID)) {
        foreach ($chooseID as $productID) {
            insert_order_details_plus($productID, $customerName);
            echo "<script>window.alert('Create successful orders for customers name: {$customerName}');</script>";
            echo "<script>window.location='../orders.php';</script>";
        }
    } else {
        echo "<script>alert('Please add products to the cart!');</script>";
        echo "<script>window.location='../orders.php';</script>";

     }
}
