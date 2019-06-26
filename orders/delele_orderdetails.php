<?php
    $conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
    if(isset($_GET['OR_ID'])) {
        $OR_ID =  $user['OR_ID'];											
        $sql = "DELETE FROM ORDERDETAILS WHERE OR_ID = $OR_ID";											
        mysqli_query($conn, $sql);
        header('location:../orders/view_orders.php');
    }
?>