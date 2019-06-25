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
    $quantities         = $_POST['quantities'];
    $choosesID          = $_POST['choosesID'];
    $productsName       = $_POST['productsName'];

    // print_r("<pre>");
    // print_r($quantities);
    // print_r("<pre>");
    // print_r($choosesID);
    // print_r("<pre>");
    // print_r($productsName);

    // foreach ($choosesID as $key => $value) {
    //     # code...
    //     echo "Key " . $key . " => Value " . $value;
    //     $num = ($value  - 1);
    //     echo " => Num " . $num;
    //     // print_r("<pre>");
    //     // print_r(var_dump($num));
    //     echo " => Gia tri quantity: " . $quantities[$num];
    //     if ($quantities[$num] != '0') {
    //         echo " => So so >= 0 : quantity " . $quantities[$num];
    //     } else {
    //         echo " => So so <= 0 : quantity " . $quantities[$num];
    //     }
    //     echo " => " . $productsName[$num];
    //     echo "<br>";
    // }

    if (!empty($customerName && $customerGender && $customerPhone)) {
        // Check ID user in the session array
        if (isset($_SESSION['u_id'])) {
            // If no choose the product to add to the cart then stop 
            if (!empty($choosesID)) {
                $staffID = $_SESSION['u_id'];
                $dateCreated = date("Y-m-d h:i");
                insert_customer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday);

                create_orders($customerName, $staffID, $dateCreated);
                
                foreach ($choosesID as $key => $productID) {
                    // Get the value of a productID
                    $index = ($productID - 1);

                    // Check the number of products 
                    if ($quantities[$index] != '0') {
                        insert_order_details_plus($productID, $customerName);
                        echo "<script>window.alert('Create successful orders for customers name: {$customerName}');</script>";
                        echo "<script>window.location='../orders.php';</script>";
                    } else {
                        echo "<script>alert('Products \"{$productsName[$index]}\" out of stock! \\nPlease choose another product in the cart!');</script>";
                        echo "<script>window.location='../orders.php';</script>";
                    }
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
