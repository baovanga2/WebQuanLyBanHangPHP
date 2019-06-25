<?php

include_once("database.php");

// Hien thi danh sach san pham de nhan vien them vao don hang
function show_products()
{
    global $conn;
    connect_db();
    $sql = "SELECT p.`pro_id` as ProductCode, p.`pro_name` as ProductName, SUM(p.`pro_quantity`) as Quantity, FORMAT(SUM(p.`pro_price`),0) as Price, p.`pro_detail` as Details
            FROM `products` p
            GROUP BY p.`pro_id`;";

    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Hien thi san pham trong don hang cua khach.
function show_order_details($ordersID)
{
    global $conn;
    connect_db();
    $sql = "SELECT p.`pro_name` as ProductName, SUM(od.`od_quantity`) as Quantity, SUM(od.`od_quantity` * p.`pro_price`) as TotalPrice, p.`pro_price` as Price, p.`pro_id` as ProductCode
    FROM `orderdetails` od, `products` p, `orders` o
    WHERE od.`pro_id` = p.`pro_id` and o.`or_id` = '$ordersID' and od.`or_id` = '$ordersID'
    GROUP BY od.`pro_id`;";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Them san pham vao trong don hang, mac dinh so luong la 1.
function insert_order_details($productID, $ordersID)
{
    global $conn;
    connect_db();
    $sqlOne = "ALTER TABLE `orderdetails` AUTO_INCREMENT = 1;";
    $sqlTwo = "INSERT INTO `orderdetails`(`pro_id`,`or_id`,`od_quantity`,`od_price`) VALUES('$productID','$ordersID',1,(SELECT `pro_price` FROM `products` WHERE `pro_id` = '$productID'));";
    $sqlThree = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') - 1 WHERE `pro_id` = '$productID'";
    mysqli_query($conn, $sqlOne);
    mysqli_query($conn, $sqlTwo);
    $result = mysqli_query($conn, $sqlThree);
    if (!$result) {
        print_r("<pre>");
        echo "Error when inserting to order details table!";
        echo "\n" . mysqli_error($conn);
    }
}


function insert_order_details_plus($productID, $customerName)
{
    global $conn;
    connect_db();
    $sqlOne = "ALTER TABLE `orderdetails` AUTO_INCREMENT = 1;";
    $sqlTwo = "INSERT INTO `orderdetails`(`pro_id`,`or_id`,`od_quantity`,`od_price`) values('$productID',(SELECT or_id FROM orders WHERE cus_id = (SELECT `cus_id` FROM `customers` WHERE `cus_fullname` = '$customerName')),1,(SELECT `pro_price` FROM `products` WHERE `pro_id` = '$productID'));";
    $sqlThree = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') - 1 WHERE `pro_id` = '$productID'";
    mysqli_query($conn, $sqlOne);
    mysqli_query($conn, $sqlTwo);
    $result = mysqli_query($conn, $sqlThree);
    if (!$result) {
        print_r("<pre>");
        echo "Error when inserting to orderdetails table!";
        echo "\n" . mysqli_error($conn);
    }
}

// Delete existing record in a `orderdetails` table
function delete_product($productID, $ordersID, $quantity)
{
    global $conn;
    connect_db();
    $sqlOne = "DELETE FROM `orderdetails` WHERE `pro_id` = '$productID' AND `or_id` = '$ordersID';";
    $sqlTwo = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') + '$quantity' WHERE `pro_id` = '$productID'";
    mysqli_query($conn, $sqlOne);
    $result = mysqli_query($conn, $sqlTwo);
    if (!$result) {
        print_r("<pre>");
        echo "Error when deleting a product in orderdetails table!";
        echo "\n" . mysqli_error($conn);
    }
}

// Hien thi danh sach don hang 
function show_orders()
{
    global $conn;
    connect_db();
    $sql = "SELECT o.or_id AS OrdersID, c.cus_fullname AS CustomerName, o.or_createddate AS CreateDate, u.u_fullname AS StaffCreated
    FROM `orders` o, `customers` c, `users` u
    WHERE o.cus_id = c.cus_id AND o.u_id = u.u_id;";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {   
            $datas[] = $rows;
        }
    }
    return $datas;
}

function show_quantity($ordersID) 
{
    # code...
    global $conn;
    connect_db();
    $sql = "SELECT sum(od.`od_quantity`) as Quantity
    FROM `orderdetails` as od, `orders` as o
    WHERE od.or_id = $ordersID
    GROUP BY od.`od_quantity`;";
    $result = mysqli_query($conn, $sql);
    if ($result == false) {
        print_r("<pre>");
        echo "Error when do geting quantity a record orders!";
        echo "\n" . mysqli_error($conn);
    }else if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {   
            $datas[] = $rows;
        }
    }
    return $datas;
}


// Xoa mot don hang
function delete_orders($ordersID, $productID, $quantity)
{
    global $conn;
    connect_db();
    $sqlOne     = "ALTER TABLE `orderdetails` DROP FOREIGN KEY fk_od_or;";
    $sqlTwo     = "ALTER TABLE `orderdetails` ADD CONSTRAINT fk_od_or FOREIGN KEY (or_id)
    REFERENCES orders (or_id) ON DELETE CASCADE ON UPDATE CASCADE;";
    $sqlThree   = "DELETE FROM `orderdetails` WHERE `pro_id` = '$productID' AND `or_id` = '$ordersID';";
    $sqlFour    = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') + '$quantity' WHERE `pro_id` = '$productID';";
    $sqlFive    = "DELETE FROM `orders` WHERE `or_id` = '$ordersID';";
    $result = mysqli_query($conn, $sqlOne);
    $result = mysqli_query($conn, $sqlTwo);
    $result = mysqli_query($conn, $sqlThree);
    $result = mysqli_query($conn, $sqlFour);
    $result = mysqli_query($conn, $sqlFive);
    if ($result == false) {
        print_r("<pre>");
        echo "Error when do deleting a record orders!";
        echo "\n" . mysqli_error($conn);
    }
    disconnect_db();
}


function get_num_products($ordersID)
{
    # code...
    global $conn;
    connect_db();
    $sql = "SELECT od.`or_id` as OrdersID, od.`pro_id` as ProductID, count(od.`od_quantity`) as Quantity
    FROM `orderdetails` as od, `orders` as o
    WHERE od.`or_id` = '$ordersID' and o.`or_id` = '$ordersID'
    GROUP BY od.`pro_id`, od.`od_quantity`;";
    $result = mysqli_query($conn, $sql);
    if ($result == false) {
        print_r("<pre>");
        echo "Error when do geting quantity a record orders!";
        echo "\n" . mysqli_error($conn);
    }else if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {   
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Insert a record into the `customers` table.
function insert_customer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday)
{
    global $conn;
    connect_db();
    $sqlOne = "ALTER TABLE `customers` AUTO_INCREMENT = 1;";
    $sqlTwo = "INSERT INTO `customers`(`cus_fullname`, `cus_email`, `cus_address`, `cus_gender`, `cus_phone`, `cus_birthday`) VALUES('$customerName', '$customerEmail', '$customerAddress', '$customerGender', '$customerPhone', '$customerBirthday');";
    mysqli_query($conn, $sqlOne);
    $result = mysqli_query($conn, $sqlTwo);
    if (!$result) {
        print_r("<pre>");
        echo "Error when inserting to customers table!";
        echo "\n" . mysqli_error($conn);
    }
}

// Function to create customers, add products to orders
function create_orders($customerName, $userID, $dateCreated)
{
    global $conn;
    connect_db();
    $sqlOne = "ALTER TABLE `orders` AUTO_INCREMENT = 1;";
    $sqlTwo = "INSERT INTO `orders`(`cus_id`,`u_id`,`or_createddate`) VALUES((SELECT `cus_id` FROM `customers` WHERE `cus_fullname` = '$customerName'), '$userID','$dateCreated');";
    mysqli_query($conn, $sqlOne);
    $result = mysqli_query($conn, $sqlTwo);
    if (!$result) {
        print_r("<pre>");
        echo "Error when inserting to orders table!";
        echo "\n" . mysqli_error($conn);
    }
}

// Update quantity products when adding to cart
function update_quantity_add($productID)
{
    global $conn;
    connect_db();
    $sqlOne = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') - 1 WHERE `pro_id` = '$productID'";
    $result = mysqli_query($conn, $sqlOne);
    if (!$result) {
        print_r("<pre>");
        echo "Error when inserting to orders table!";
        echo "\n" . mysqli_error($conn);
    }
}

function update_quantity_delete($productID, $quantity) {
    global $conn;
    connect_db();
    $sqlOne = "UPDATE `products` SET `pro_quantity` = (SELECT `pro_quantity` FROM (SELECT * FROM products) as Price WHERE `pro_id` = '$productID') + '$quantity' WHERE `pro_id` = '$productID'";
    $result = mysqli_query($conn, $sqlOne);
    if (!$result) {
        print_r("<pre>");
        echo "Error when deleting to orders table!";
        echo "\n" . mysqli_error($conn);
    }
}


