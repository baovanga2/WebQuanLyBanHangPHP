<?php
session_start();
include_once("./db_driver.php");

if (isset($_POST['smOrders'])) {
    // Get customer information
    $customerName       = $_POST['customerName'];
    $customerBirthday   = $_POST['customerBirthday'];
    $customerAddress    = $_POST['customerAddress'];
    $customerEmail      = $_POST['customerEmail'];
    $customerPhone      = $_POST['customerPhone'];
    $customerGender     = $_POST['customerGender'];
    if (!empty($customerName && $customerGender && $customerPhone)) {
        InsertCustomer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday);
    } else {
        echo "<script>alert('Do not leave the required fields blank');</script>";
        echo "<script>window.location='../create_orders.php';</script>";
    }

    if (isset($_SESSION['u_id'])) {
        $staffID = $_SESSION['u_id'];
        $dateCreated = date("Y-m-d h:i");
        CreateOrders($customerName, $staffID, $dateCreated);
    } else {
        echo "<script>alert('Session is empty!');</script>";
        echo "<script>window.location='../create_orders.php';</script>";
    }

    $chooseID = $_POST['chooseID'];
    // print_r(var_dump($chooseID));
    foreach($chooseID as $productID) {
        InsertOrderdetailsPlus($productID, $customerName);
        echo "<script>window.alert('Create successful orders for customers name: {$customerName}');</script>";
        echo "<script>window.location='../add_orders.php';</script>";

    }


}
