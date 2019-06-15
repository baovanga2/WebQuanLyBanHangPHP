<?php

include_once("database.php");

// Hien thi danh sach san pham de nhan vien them vao don hang
function ShowProducts()
{
    global $conn;
    connect_db();
    $sql = "SELECT products.*, categories.ca_name
                FROM products
                JOIN categories
                ON categories.ca_id = products.ca_id;";

    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Hien thi san pham trong don hang cua khach
function ShowOrderDetails()
{
    global $conn;
    connect_db();
    $sql = "SELECT o.or_id AS CodeOrders, c.cus_fullname AS CustomerName, p.pro_name AS ProductName, od.od_quantity AS Quantity, od.od_price AS Price
            FROM customers c, orders o, orderdetails od, products p, users u
            WHERE o.cus_id = c.cus_id AND od.or_id = 3 AND o.or_id = 3 AND p.pro_id = od.pro_id AND o.u_id = u.u_id;";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Them san pham vao don hang
function InsertProduct($productID, $orderID, $quantity)
{
    global $conn;
    connect_db();
    $sql = "";
    $result = mysqli_query($conn, $sql);
}


// Hien thi danh sach don hang 
function ShowOrders()
{
    global $conn;
    connect_db();
    $sql = "SELECT o.or_id as OrdersID, c.cus_fullname as CustomerName, o.or_createddate as CreateDate, u.u_fullname as StaffCreated
            FROM orders o, customers c, users u 
            WHERE o.cus_id = c.cus_id and o.u_id = u.u_id;";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $datas[] = $rows;
        }
    }
    return $datas;
}

// Xoa mot don hang
function DeleteOrders($ordersID)
{
    global $conn;
    connect_db();
    $sqlOne     = "ALTER TABLE orderdetails DROP FOREIGN KEY fk_od_or;";
    $sqlTwo     = "ALTER TABLE orderdetails ADD CONSTRAINT fk_od_or FOREIGN KEY (or_id)
    REFERENCES orders (or_id) ON DELETE CASCADE ON UPDATE CASCADE;";
    $sqlThree   = "DELETE FROM orders WHERE or_id = $ordersID;";
    mysqli_query($conn, $sqlOne);
    mysqli_query($conn, $sqlTwo);
    mysqli_query($conn, $sqlThree);
}
