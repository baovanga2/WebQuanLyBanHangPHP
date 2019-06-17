<?php

include_once("database.php");

// Hien thi danh sach san pham de nhan vien them vao don hang
function ShowProducts()
{
    global $conn;
    connect_db();
    $sql = "SELECT p.pro_id as ProductCode, p.pro_name as ProductName, SUM(p.pro_quantity) as Quantity, FORMAT(SUM(p.pro_price),0) as Price, p.pro_detail as Details
            FROM products p
            GROUP BY p.pro_id;";

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
function ShowOrderDetails($ordersID)
{
    global $conn;
    connect_db();
    $sql = "SELECT p.pro_name as ProductName, SUM(od.od_quantity) as Quantity, SUM(od.od_quantity * p.pro_price) as Price
    FROM orderdetails od, products p, orders o
    WHERE od.pro_id = p.pro_id and o.or_id = $ordersID
    GROUP BY od.pro_id;";
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
