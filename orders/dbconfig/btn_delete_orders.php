<?php
include_once("db_driver.php");
if (isset($_GET['deleteOrders'])) {
    $orderID = $_GET['idOrders'];
    DeleteOrders($orderID);
    header("Location:http://localhost/WebQuanLyBanHangPHP/order/add_order.php");
    disconnect_db();

}

if (isset($_GET['editOrders'])) {
    $orderID = $_GET['idOrders'];
    // ShowOrderDetails($orderID);
    header("Location:http://localhost/WebQuanLyBanHangPHP/order/order_products.php");
    disconnect_db();
}
?>
