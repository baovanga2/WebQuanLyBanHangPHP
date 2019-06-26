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
    $quantity           = $_POST['quantity'];
    $chooseID           = $_POST['chooseID'];


    if (!empty($customerName && $customerGender && $customerPhone && $quantity)) {
        // Check ID user in the session array
        if (isset($_SESSION['u_id'])) {
            // If no choose the product to add to the cart then stop 
            if (!empty($chooseID)) {
                $staffID = $_SESSION['u_id'];
                $dateCreated = date("Y-m-d h:i");
                insert_customer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday);
                create_orders($customerName, $staffID, $dateCreated);
                foreach ($chooseID as $productID) {
                    insert_order_details_plus($productID, $customerName);
                    echo "<script>window.alert('Create successful orders for customers name: {$customerName}');</script>";
                    echo "<script>window.location='../orders.php';</script>";
                }
            } else {
                echo "<script>alert('Please select a product to create a shopping cart!');</script>";
                echo "<script>window.location='../create-orders.php';</script>";
            }
        } else {
            echo "<script>alert('Please login again!');</script>";
            echo "<script>window.location='../../home/homepage.php;</script>";
        }
    } else {
        echo "<script>alert('Complete here with all the necessary information in the section marked with (*)');</script>";
        echo "<script>window.location='../create-orders.php';</script>";
    }
}
