<?php
include_once("db_driver.php");
if (isset($_GET['deleteOrder'])) {
    $orderID = $_GET['idOrder'];
    DeleteOrder($orderID);
    header("Location:http://localhost/WebQuanLyBanHangPHP/order/add_order.php");
    disconnect_db();

}

if (isset($_GET['addOrder'])) {
    $orderID = $_GET['idOrder'];
    header("Location:http://localhost/WebQuanLyBanHangPHP/order/order_products.php");
    disconnect_db();
}
?>