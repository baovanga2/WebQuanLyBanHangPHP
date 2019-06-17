<?php
    include_once("db_driver.php");
    function getOrdersID() {
        $ordersID;
        if(isset($_GET['editOrders'])) {
            $ordersID = $_GET['ordersID'];
        }
        return $ordersID;
    } 
      
    if (isset($_GET['deleteOrders'])) {
        $ordersID = $_GET['ordersID'];
        DeleteOrders($ordersID);
        header("Location:http://localhost/WebQuanLyBanHangPHP/orders/add_orders.php");
        disconnect_db();

    }

    if (isset($_GET['editOrders'])) {
        $ordersID = $_GET['ordersID'];
        // echo $ordersID;
        // ShowOrderDetails($orderID);
        header("Location:http://localhost/WebQuanLyBanHangPHP/orders/order_products.php");
        disconnect_db();
    }

?>
