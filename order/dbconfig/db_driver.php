<?php

include_once("database.php");

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


function ShowOrderDetails()
{
    global $conn;
    connect_db();
    $sql = "SELECT o.*, c.cus_fullname, u.u_fullname, p.pro_name, ot.od_quantity, p.pro_price, p.pro_id
            FROM orders as o, orderdetails as ot, products as p, customers as c, users as u
            WHERE o.cus_id = c.cus_id and o.u_id = u.u_id and ot.or_id = o.or_id and ot.pro_id = p.pro_id;";
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

function ShowOrders()
{
    global $conn;
    connect_db();
    $sql = "SELECT o.or_id as OrderID, c.cus_fullname as CustomerName, o.or_createddate as CreateDate, u.u_fullname as StaffCreated
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

function DeleteOrder($orderID)
{
    global $conn;
    connect_db();
    $sqlOne     = "ALTER TABLE orderdetails DROP FOREIGN KEY fk_od_or;";
    $sqlTwo     = "ALTER TABLE orderdetails ADD CONSTRAINT fk_od_or FOREIGN KEY (or_id)
    REFERENCES orders (or_id) ON DELETE CASCADE ON UPDATE CASCADE;";
    $sqlThree   = "DELETE FROM orders WHERE or_id = $orderID;";
    mysqli_query($conn, $sqlOne);
    mysqli_query($conn, $sqlTwo);
    mysqli_query($conn, $sqlThree);
}
